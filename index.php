<?php
include("attic.php");

$img = scandir("img");
$imgcount = count($img) - 2; // Gotta account for "." and ".."
$size = 0;
foreach($img as $file) { // Not accounting for them here though, cause it's a pain in the ass and they're miniscule
	$size += filesize("img/" . $file);
}
$size = round(($size/1024)/1024, 2);
$bandwidth = round((file_get_contents("bandwidth.txt")/1024)/1024, 2);

echo "

<div class='dp50body ltext' style='background-color:#666;'>
	<h2>What is Magic Mirror?</h2>
	<p>Magic Mirror is a custom encrypted image host. Nothing you post here can be seen by anybody (including me) due to the way the encryption works unless they're sent a URL with a decryption key in it.<br />Also, it's worth noting that the URL-based uploader can take onion, i2p, and clearweb URLs.</p>
	<h2>What file types are accepted?</h2>
	<p>We currently only accept jpg, gif, and png, due to the way the encryption works with PHP GD libraries. It is unlikely that other image formats will be supported in the future.</p>
	<h2>Are there rules?</h2>
	<p><strong>Yes, there are absolutely rules.</strong> There are two prime rules here.
	<ul>
		<li><strong>No child pornography.</strong> Don't upload anything that is even vaguely erotic and features anybody who could in any way be perceived as being under 18 years old. If it gets reported to me, I'll delete it.</li>
		<li>Nothing else that will get my site attacked. I'm here to host images, getting tracked and DDoS'd and any other hostile shit being directed at me could force me to shut this service down. I don't have the resources to mitigate attacks, so don't upload anything that'll get my service attacked.</li>
	</ul>
	If you see something that breaks these rules, <strong>email me at <a href='mailto:cherami@tormail.net'>cherami@tormail.net</a>.</strong> Include the URL to the image so that I can remove it if it does break one of these rules.</p>
</div>
<div class='dp50body dtext' style='background-color:#999;'>
	<h2>Stats</h2>
	<p><em>Currently indexing <strong>$imgcount</strong> images, consuming a total of <strong>$size MB</strong>, and having consumed approximately <strong>$bandwidth MB of bandwidth</strong>.</em></p>
	<h2>Misc</h2>
	<p>Contact email is <a href='mailto:cherami@tormail.net'>cherami@tormail.net</a>. A PGP key is available <a href='pgp.txt'>here</a>. If at any time you want me to PGP sign a message for verification purposes, ask and I'll gladly do so.
	<br />Source is available <a href='http://github.com/CherAmi/MagicMirror'>here</a>.
	<br />Now available as magicmirror.i2p!</p>
	<center><h2>Upload<br /></h2></center>
	<div class='dp50'>
		<center>
			<h2>File</h2>
			<form action='upload.php' method='post' enctype='multipart/form-data'>
				<input type='file' name='pic'>

				<input type='submit' value='Upload'>
			</form>
		</center>
	</div>

	<div class='dp50'>
		<center>
			<h2>URL</h2>
			<form action='upload.php' method='post'>

				<input type='text' name='url' placeholder='Image URL'>
				<input type='submit' value='Upload'>
			</form>

		</center>
	</div>
</div>

";

include("basement.php");
?>
