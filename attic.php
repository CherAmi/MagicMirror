<?php
echo "<html>
<head>
<title>Magic Mirror</title>
<style>
/*
	CSS FROM http://www.vcarrer.com/2009/06/1-line-css-grid-framework.html
*/

body {background: #222;}

a, a:active, a:visited, a:hover {text-decoration: none; color: #df0000;}

.main {margin:0 auto; width:90%;} 

.ltext {color:#222;}
.dtext {color:#111;}

.dp50{width:50%; float:left; display: inline; *margin-right:-1px; height:80px;}
.dp50nav{width:100%; float:left; display: inline; *margin-right:-1px; padding: 5px; height:20px;}
.dp50body{width:50%; float:left; display: inline; *margin-right:-1px; height:700px;}

.dp25{width:25%; float:left; display: inline; *margin-right:-1px; height:80px;}
.dp100{width:100%; float:left; display: inline; *margin-right:-1px; height:80px;}

</style>
</head>

<body>
<div class='main'>

<center><a href='index.php'>
	<div class='dp50' style='background-color:#bbb;'><h1 style='color:#444'>Magic</h1></div>
	<div class='dp50' style='background-color:#444;'><h1 style='color:#bbb'>Mirror</h1></div>
</a></center>
<div class='dp50nav' style='background-color: #111111; color: #eeeeee;'><center>
| <a href='newimage.php'>upload image</a> | <a href='newalbum.php'>start an album</a> | <a href='addtoalbum.php'>add to an album</a> | <a href='deletealbum.php'>delete an album</a> | 
</center></div>

";
?>
