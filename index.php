<?php
include("attic.php");

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
	<div class='dp50'>
		<center>
			<h2>File upload</h2>
			<form action='upload.php' method='post' enctype='multipart/form-data'>
				<input type='file' name='pic'>
				<input type='submit' value='Upload'>
			</form>
		</center>
	</div>
	<div class='dp50'>
		<center>
			<h2>URL upload</h2>
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
