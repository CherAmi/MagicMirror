<?php
include("cryptlib.php");
$img = $_GET['img'];
$key = $_GET['key'];

function imgerror($errstr) {
	header("Content-Type: image/png");
	$im = imagecreate(300, 25);
	$background_color = imagecolorallocate($im, 0, 0, 0);
	$text_color = imagecolorallocate($im, 233, 14, 28);
	imagestring($im, 2, 5, 5,  $errstr, $text_color);
	imagepng($im);
	imagedestroy($im);
	die();
}

if(isset($img) && isset($key)) {
	if(!file_exists("img/$img")) { imgerror("Invalid image file"); }
	$encimg = file_get_contents("img/$img");
	$crypt = new Crypt_AES(CRYPT_AES_MODE_ECB);
	$crypt->setKey($key);
	$decimg = $crypt->decrypt($encimg);

	if($decimg == "") { imgerror("Incorrect password"); }

	$tempfile = md5(rand(0, 0x7FFFFF));
	file_put_contents("img/$tempfile", $decimg);

	$imgtype = exif_imagetype("img/$tempfile");

	if($imgtype == IMAGETYPE_GIF) {
		$im = imagecreatefromgif("img/$tempfile");
		header("Content-Type: image/gif");
		imagegif($im);
	} elseif($imgtype == IMAGETYPE_PNG) {
		$im = imagecreatefrompng("img/$tempfile");
		header("Content-Type: image/png");
		imagegif($im);
	} elseif($imgtype == IMAGETYPE_JPEG) {
		$im = imagecreatefromjpeg("img/$tempfile");
		header("Content-Type: image/jpeg");
		imagegif($im);
	} else {
		$im = imagecreatefromstring($decimg);
		header("Content-Type: image/gif");
		imagegif($im);
	}
	
	$imagesize = filesize("img/$tempfile");
	$currentbandwidth = file_get_contents("bandwidth.txt");
	$f = fopen("bandwidth.txt", "w+");
	fwrite($f, $currentbandwidth + $imagesize);
	fclose($f);
	unlink("img/$tempfile");

} else {
	imgerror("Image or key not set");
}

?>
