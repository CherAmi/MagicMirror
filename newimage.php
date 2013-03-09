<?php
include("attic.php");

echo "
<div class='dp50body ltext' style='background-color:#666;'>
	<h2>Upload via file</h2>
	<p>
		<form action='upload.php' method='post' enctype='multipart/form-data'>
			<input type='file' name='pic' style='width: 100%'>
			<input type='text' name='plen' placeholder='Desired password length (must be >=2)' style='width: 50%'><br />
			<input type='text' name='nickname' placeholder='Nickname (optional)' style='width: 50%'><br />
			<input type='text' name='album' placeholder='Album key (optional)' style='width: 50%'><br />
			<input type='submit' value='Upload'>
		</form>
		<p><em>Notice: Nicknamed images cannot be deleted.</em></p>
	</p>
</div>
<div class='dp50body dtext' style='background-color:#999;'>
	<h2>Upload via URL</h2>
	<p>
		<form action='upload.php' method='post'>
			<input type='text' name='url' placeholder='Image URL' style='width: 50%'><br />
			<input type='text' name='plen' placeholder='Desired password length (must be >=2)' style='width: 50%'><br />
			<input type='text' name='nickname' placeholder='Nickname (optional)' style='width: 50%'><br />
			<input type='text' name='album' placeholder='Album key (optional)' style='width: 50%'><br />
			<input type='submit' value='Upload'>
		</form>
		<p><em>Notice: Nicknamed images cannot be deleted.</em></p>
	</p>
</div>
";

include("basement.php");
?>
