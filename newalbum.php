<?php
include("attic.php");

$albumkey = hash("md5", rand(0, 0x7FFFFF));
$pub = hash("crc32", $albumkey);
mkdir("a/$pub", 777);
chmod("a/$pub", 0777);

echo "
<div class='ltext' style='background-color:#666;'>
	<h2>New album</h2>
	<p>Your album key is <em><b>$albumkey</b></em>. Don't share it - this key allows you to add images to an album or delete the album.<br />
To view your album, click <a href='album.php?album=$pub'>here</a>.</p><br />

</div>
";

include("basement.php");
?>
