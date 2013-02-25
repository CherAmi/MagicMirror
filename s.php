<?php
$img = preg_replace("/\W/", "", str_replace(" ", "_", $_POST['img']));
$short = preg_replace("/\W/", "", str_replace(" ", "_", $_POST['short']));
$key = $_POST['key'];

if(!file_exists("img/$img")) {
die("Invalid image specified");
}

if(strlen($short) < 1 || $short == "" || !isset($short)) {
die("Invalid nickname");
}

if(file_exists("img/$short")) {
die("Nickname already in use");
}

copy("img/$img", "img/$short");
header("Location: image.php?img=$short&key=$key");
?>
