<?php
$i2p = "http://j4mosyh4wdjga2pz4jiwxq5td4n4jnnxeru2kciiv3ebjzsnkcda.b32.i2p";
$onion = "http://li7qxmk72kp3sgz4.onion";
include("cryptlib.php");
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
		
		$key = md5(rand(0, 0x7FFFFF));
		$rand = hash("crc32", rand(0, 0x7FFFFF));

		$crypt = new Crypt_AES(CRYPT_AES_MODE_ECB);
		$crypt->setKey($key);
		
		$encrypted = $crypt->encrypt($result);
		file_put_contents("img/" . $rand, $encrypted);
		include("attic.php");
		
		echo "
		<div class='ltext' style='background-color:#666; width:100%;'>
			<h2>Image uploaded successfully.</h2>
			<p>View it on <a href='$i2p/image.php?img=$rand&key=$key'>i2p</a> or <a href='$onion/image.php?img=$rand&key=$key'>Tor</a>. <em>Do not lose this URL. Without the key attached, this URL is useless and will just give you an error message, and we're powerless to get the key back for you.</em></p>
		</div>
		";

		include("basement.php");
	} else {
		die("Invalid image format. Accepted types are jpg, png, gif, and jpeg.");
	}
} elseif(isset($_FILES['pic'])) {
	$key = md5(rand(0, 0x7FFFFF));
	$rand = md5(rand(0, 0x7FFFFF));

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
			<p>View it <a href='image.php?img=$rand&key=$key'>here</a>. <em>Do not lose this URL. Without the key attached, this URL is useless and will just give you an error message, and we're powerless to get the key back for you.</em></p>
		</div>
		";

		include("basement.php");
	} else {
		die("Invalid image format. Accepted types are jpg, png, gif, and jpeg.");
	}
} else {
	include("attic.php");
	echo "
	<div class='dp50 ltext' style='background-color:#666;'>
		<h1>ERROR</h1>
	</div>
	<div class='dp50 dtext' style='background-color:#999;'>
		<h2>No file or URL specified</h2>
	</div>
	";
	include("basement.php");
}

?>
