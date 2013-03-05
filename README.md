Magic Mirror
============

**[On Tor](http://li7qxmk72kp3sgz4.onion/)**
**[Onion alt](http://4344457357774542.onion/)**
**[On i2p](http://img.i2p/)**
**[On the clearnet](http://img.404.mn/)**

A small, secure, and easy to use encrypted imagehost. Bitcoin donations welcome at *14JGX4sKbejEzRyWgak98ig7nhoa6Jjpyr*!

**Features**
* Can upload images via URL or file
* Uses Tor to mirror images (made to prevent hidden services' IPs from being leaked)
* Can mirror images from i2p websites as well, though you'll need to have i2p installed on your box to do so

Note: If you don't have Tor on whatever box you run this on, you'll need to change the proxy settings in upload.php.

**Known vulnerabilities**
* If a web server keeps access logs and those access logs include GET parameters, an attacker with access to the logs can see the decryption keys to files. (To fix this vuln is possible and not particularly hard. However, it removes all potential for image embedding. You'll just have to trust the host in this case.)

**Legal**

I don't care what you do with this file. If you have the source, all of the work I've put in this may as well be yours. You can take my name off of it, change the name of the software, you can do *ANYTHING* you want with it. 'Mi casa es su casa' as the Spanish would say. All I ask is that, if you do use this source elsewhere, that you not use it for malicious purposes and that you not try to view what users upload without their knowledge.

**Credits**

* Me, for writing the code (obviously)
* The good people who developed PHP
* The [phpSecLib](http://phpseclib.sourceforge.net/) dev team, for their AES and Rjindael libraries 
* A few various other sources for snippets of CSS

**Installation**

* 1.) Clone this repository
* 2.) Make a directory named "img"
* 3.) Chmod upload.php to be able to write to the img directory
* 4.) Chmod bandwidth.txt and image.php so that image.php can write bandwidth stats properly
* 5.) Spread the link around!

- *Cher Ami*
