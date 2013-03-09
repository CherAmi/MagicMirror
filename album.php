<?php
include("attic.php");

$album = $_GET['album'];
$album = preg_replace("/\W/", "", $album);

if(file_exists("a/$album")) {
	echo "<div class='ltext' style='background-color:#666;'>";
	$albumpics = scandir("a/$album/");
	foreach($albumpics as $pic) {
		echo "		
		<img src='image.php?img=$pic' /><br />
		";
	}
	echo "</div>";
} else {
	echo "
<div class='ltext' style='background-color:#666;'>
<h2>Error</h2>
<p>No such album.</p>
</div>
";
}

include("basement.php");
?>
