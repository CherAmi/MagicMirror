<?php
$img = preg_replace("/\W/", "", $_GET['img']);
$deletionkey = $_GET['deletionkey'];

if(!file_exists("img/" . $img)) {
	die("Invalid image");
}
if(hash("crc32", $deletionkey) == $img) {
	unlink("img/" . $img);
	echo "Image deleted";
} else {
	die("Incorrect deletion key");
}
?>
