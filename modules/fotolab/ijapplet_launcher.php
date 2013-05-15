<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
?>
<!-- Runs ImageJ as an Apple -->

<html>
<head>
<title>Editing image with ImageJ</title>
</head>
<body>

<h2>Editing image with ImageJ</h2>

<applet code="IJApplet.class" archive="ij.jar" width=0 height=0>
<param name=url value="<?php echo "$httprotocol://$main_domain/fotos/encounter/$pn/$img"; ?>">
</applet>

<p>
<a href="javascript:window.history.back()">Back</a>
</p>
</body>
</html>