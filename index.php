<?php
include("attic.php");

$img = scandir("img");
$imgcount = count($img) - 2; // Gotta account for "." and ".."
$size = 0;
foreach($img as $file) { // Not accounting for them here though, cause it's a pain in the ass and they're miniscule anyway
	$size += filesize("img/" . $file);
}
$size = round(($size/1024)/1024, 2);
$bandwidth = round((file_get_contents("bandwidth.txt")/1024)/1024, 2);

echo "

<div class='dp50body ltext' style='background-color:#666;'>
	<h2>Note to authorities/other interested parties</h2>
	<p>This service <b>is not hosted on img.404.mn</b>. Seizing, ddosing, or taking any other hostile action towards img.404.mn will have no affect on the Tor/i2p gateways.<br />
	<h2>What is Magic Mirror?</h2>
	<p>Magic Mirror is an encrypted, <a href='https://github.com/CherAmi/MagicMirror/'>open source</a>, anonymous image host. We have gateways on Tor, i2p, and the clear web. We allow uploads both by file and URL.</p>
	<h2>Are there rules?</h2>
	<p><strong>Yes, there are absolutely rules.</strong>
	<ul>
		<li><strong>No child pornography.</strong> Don't upload anything that is even vaguely erotic if it features anybody who could in <em>any</em> way be perceived as being <18 years old.</li>
		<li>Nothing that will cause uproar and get my site attacked. I don't have the resources to mitigate attacks on this service.</li>
	</ul>
	If you see something that breaks these rules email me a link and I'll remove it.</p>
</div>
<div class='dp50body dtext' style='background-color:#999;'>
	<h2>Upload<br /></h2>
	<div style='height: 30%'>
	<div class='dp50'>
		<center>
			<h2>File</h2>
			<form action='upload.php' method='post' enctype='multipart/form-data'>
				<input type='file' name='pic' style='width: 100%'>
				<input type='text' name='plen' placeholder='Desired password length (must be >=2)' style='width: 100%'><br />
				<input type='submit' value='Upload'>
			</form>
		</center>
	</div>

	<div class='dp50'>
		<center>
			<h2>URL</h2>
			<form action='upload.php' method='post'>
				<input type='text' name='url' placeholder='Image URL' style='width: 100%'><br />

				<input type='text' name='plen' placeholder='Desired password length (must be >=2)' style='width: 100%'><br />
				<input type='submit' value='Upload'>
			</form>
		</center>
	</div>
	</div>
	<h2>Stats</h2>
	<p><em>Currently indexing <strong>$imgcount</strong> images, consuming a total of <strong>$size MB of disk space</strong> and ~<strong>$bandwidth MB of bandwidth</strong>.</em></p>
	<h2>Misc</h2>
	<p>Contact email: <a href='mailto:cherami@tormail.net'>cherami@tormail.net</a>. A PGP key is available <a href='pgp.txt'>here</a>.
	<br />Bitcoin donations welcome! Address is <em>14JGX4sKbejEzRyWgak98ig7nhoa6Jjpyr</em>. Your donations help keep this service alive.
	<br /></p>
	<h2>Want to run a mirror?</h2>
	<p>The source is available <a href='https://github.com/CherAmi/MagicMirror'>here</a> and you can download a zip file of all of the images currently hosted here <a href='vault.zip'>here</a>. Email me at cherami@tormail.net and I'll put a link to your mirror here. Please include when your mirror was last updated on the index page if you run one, so people know what URLs will and won't work.</p><br />
</div>

";

include("basement.php");
?>
