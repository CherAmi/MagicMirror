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
if($key > 1 && $key < 65) {
	$key = randString($key);
} else {
	$key = randString(16);
}

$rand = hash("crc32", rand(0, 0x7FFFFF));

$i2p = "http://img.i2p";
$onion = "http://li7qxmk72kp3sgz4.onion";


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
		include("attic.php");
		
		echo "
		<div class='ltext' style='background-color:#666; width:100%;'>
			<h2>Image uploaded successfully.</h2>
			<p>View it on <a href='$i2p/image.php?img=$rand&key=$key'>img.i2p</a> or <a href='$onion/image.php?img=$rand&key=$key'>li7qxmk72kp3sgz4.onion</a>. <em>Do not lose this URL. Without the key attached, this URL is useless and will just give you an error message, and we're powerless to get the key back for you.</em><br /></p>
			
			<h2>Nickname?</h2>
			<p>If you'd like to give this image a nickname, use the form below. Please don't nickname the same image too many times if you can avoid doing so, it consumes a lot of hard drive space.
			<form action='s.php' method='post'>
				<input type='text' name='short' placeholder='Nickname for this image'><br />
				<input type='hidden' name='img' value='$rand'>
				<input type='hidden' name='key' value='$key'>
				<input type='submit' value='Nickname'>
			</form>
			</p>
		</div>
		";

		include("basement.php");
	} else {
		die("Invalid image format. Accepted types are jpg, png, gif, and jpeg.");
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
		include("attic.php");

		echo "
		<div class='ltext' style='background-color:#666; width:100%;'>
			<h2>Image uploaded successfully.</h2>
			<p>View it on <a href='$i2p/image.php?img=$rand&key=$key'>img.i2p</a> or <a href='$onion/image.php?img=$rand&key=$key'>li7qxmk72kp3sgz4.onion</a>. <em>Do not lose this URL. Without the key attached, this URL is useless and will just give you an error message, and we're powerless to get the key back for you.</em><br /></p>
			
			<h2>Nickname?</h2>
			<p>If you'd like to give this image a nickname, use the form below. Please don't nickname the same image too many times if you can avoid doing so, it consumes a lot of hard drive space.
			<form action='s.php' method='post'>
				<input type='text' name='short' placeholder='Nickname for this image'><br />
				<input type='hidden' name='img' value='$rand'>
				<input type='hidden' name='key' value='$key'>
				<input type='submit' value='Nickname'>
			</form>
			</p>
		</div>
		";

		include("basement.php");
	} else {
		die("Invalid image format. Accepted types are jpg, png, gif, and jpeg.");
	}
} else {
	echo "No file or url specified";
}

?>
