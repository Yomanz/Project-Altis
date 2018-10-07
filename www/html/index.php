<?php
//Provides Classes: SiteConfig(), DBConfig()
include "/var/www/config/config.php";
$site_config = new SiteConfig();
?>

<html>
<head>
	<title><?php echo $site_config->site_title; ?></title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>


<p>oi m8, sign up or log in <a href="/login">here</a></p>


</body>

</html>