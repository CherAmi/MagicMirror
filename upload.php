<?php
include("cryptlib.php");

function randString($len) {
        $len = intval($len);
        $alph = array_merge(range("a", "z"), range("A", "Z"));
        $ret = "";
        while($len > 0) {
                $len = $len - 1;
                $ret = $ret . $alph[rand(0, count($alph) - 1)];
        }
        return $ret;
}

// gettld function from http://codepad.org/LSQ1VyyL
function gettld( $url )
{
	$tld = '';
	$url_parts = parse_url((string)$url);
	if(is_array($url_parts) && isset($url_parts['host']))
	{
		$host_parts = explode('.', $url_parts['host'] );
		if(is_array($host_parts) && count($host_parts) > 0 )
		{
			$tld = array_pop($host_parts);
		}
	}
	return $tld;
}

$key = intval($_POST['plen']);
if($key > 1) {
	$key = randString($key);
} else {
	$key = randString(16);
}






$deletionkey = hash("whirlpool", rand(0, 0x7FFFFF));
$rand = hash("crc32", $deletionkey);
if(isset($_POST['nickname']) && strlen($_POST['nickname']) > 1) {
	$rand = $_POST['nickname'];
	$rand = str_replace(" ", "_", $rand);
	$rand = preg_replace("/\W/", "", $rand);
}

$album = hash("crc32", $_POST['album']);

$i2p = "http://img.i2p";
$onion = "http://li7qxmk72kp3sgz4.onion";
$onion2 = "http://4344457357774542.onion";
$clear = "http://img.404.mn";

$successtext = "
		<div class='ltext' style='background-color:#666; width:100%;'>
			<h2>Image uploaded successfully.</h2>
			<p>Viewing it:
			<ul>
				<li>i2p: <a href='$i2p/image.php?img=$rand&key=$key'>$i2p/image.php?img=$rand&key=$key</a></li>
				<li>Tor: <a href='$onion/image.php?img=$rand&key=$key'>$onion/image.php?img=$rand&key=$key</a></li>
				<li>Tor (alt): <a href='$onion2/image.php?img=$rand&key=$key'>$onion2/image.php?img=$rand&key=$key</a></li>
				<li>Clearnet: <a href='$clear/image.php?img=$rand&key=$key'>$clear/image.php?img=$rand&key=$key</a></li>
			</ul><br />
			To delete it, click <a href='delete.php?img=$rand&deletionkey=$deletionkey'>here</a>.<br />
			<em>Do not lose your image URL or the deletion URL. To be able to view or delete your image, you will need the URLs on this page.</em><br /><br />
			The name of this image (in case you want to add it to an album later) is $rand.<br />
			</p>
		<br /></div>
";


if(isset($_POST['url']) && $_POST['url'] != "") {
	$url = $_POST['url'];

	if(gettld($url) != "i2p") {
		$proxy = "127.0.0.1:9050";
	} else {
		$proxy = "127.0.0.1:4444";
	}

	$ext = explode(".", $url);
	$ext = end($ext);
	$ext = strtolower($ext);

	if($ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jpeg") {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
		$result = curl_exec($ch);

		if(preg_match("/image\/[a-zA-Z]*/", curl_getinfo($ch, CURLINFO_CONTENT_TYPE)) == false) {
			die("Image returned invalid headers.");
		}

		$crypt = new Crypt_AES(CRYPT_AES_MODE_ECB);
		$crypt->setKey($key);

		$encrypted = $crypt->encrypt($result);
		file_put_contents("img/" . $rand, $encrypted);
		if(isset($_POST['album']) && file_exists("a/" . hash("crc32", $_POST['album']))) { file_put_contents("a/$album/$rand", " "); }

		include("attic.php");
		echo $successtext;
		include("basement.php");
	} else {
		include("attic.php");
		die("Invalid image format. Accepted types are jpg, png, gif, and jpeg.");
		include("basement.php");
	}
} elseif(isset($_FILES['pic'])) {

	$name = $_FILES['pic']['name'];
	$ext = explode(".", $name);
	$ext = end($ext);
	$ext = strtolower($ext);

	if($ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jpeg") {
		move_uploaded_file($_FILES['pic']['tmp_name'], "img/$rand");
		$decimg = file_get_contents("img/$rand");
		$crypt = new Crypt_AES(CRYPT_AES_MODE_ECB);
		$crypt->setKey($key);
		$encimg = $crypt->encrypt($decimg);
		file_put_contents("img/$rand", $encimg);
		if(isset($_POST['album']) && file_exists("a/" . hash("crc32", $_POST['album']))) { file_put_contents("a/$album/$rand", " "); }

		include("attic.php");
		echo $successtext;
		include("basement.php");
	} else {
		include("attic.php");
		die("Invalid image format. Accepted types are jpg, png, gif, and jpeg.");
		include("basement.php");
	}
} else {
	include("attic.php");
	echo "No file or url specified";
	include("basement.php");
}

?>
