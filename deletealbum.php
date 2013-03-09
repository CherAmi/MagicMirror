<?php
include("attic.php");

if(!isset($_POST['albumkey'])) {
	echo "
<div class='ltext' style='background-color:#666;'>
	<h2>Delete album</h2>
	<form action='deletealbum.php' method='post'><br />
		<input type='text' name='albumkey' placeholder='Album key'><br />
		<input type='submit' value='Delete album'>
	</form><br />
</div>
";
} else {
	$albumkey = $_POST['albumkey'];
	$album = hash("crc32", $albumkey);
	if(file_exists("a/$album")) {
		$contents = scandir("a/$album");
		foreach($contents as $img) {
			unlink("a/$album/$img");
		}
		rmdir("a/$album");
		echo "<div class='ltext' style='background-color:#666;'>
		<h2>Success!</h2>
		<p>Album <em><strong>$album</strong></em> deleted.</p><br />
		</div>
		";
	} else { echo "<div class='ltext' style='background-color:#666;'>
		<h2>Error</h2>
		<p>Invalid album key.</p><br />
		</div>
		";
}
}

include("basement.php");
?>
