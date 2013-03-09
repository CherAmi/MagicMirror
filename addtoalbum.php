<?php
include("attic.php");

if(!isset($_POST['albumkey'])) {
	echo "
	<div class='ltext' style='background-color:#666;'>
		<h2>Add album to image</h2>
		<form action='addtoalbum.php' method='post'>
			<input type='text' name='albumkey' placeholder='Album key' style='width: 50%;'><br />
			<input type='text' name='img' placeholder='Image name' style='width: 50%;'><br />
			<input type='submit'><br />
		</form>
	<br />
	</div>
	";
} else
{
	$albumkey = $_POST['albumkey'];
	$album = hash("crc32", $albumkey);
	$img = $_POST['img'];
	$img = preg_replace("/\W/", "", $img);
	if(file_exists("a/$album")) {
		$f = fopen("a/$album/$img", "w+");
		fclose($f);
		echo "
<div class='ltext' style='background-color:#666;'>
<h2>Success!</h2>
<p>Image added to album <strong><em>$album</em></strong>. View your album <a href='album.php?album=$album'>here</a>.</p><br />
</div>
";
	} else { echo "Invalid album key"; }
}

include("basement.php");
?>
