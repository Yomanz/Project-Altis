<?php
//Provides Classes: SiteConfig(), DBConfig()
require_once "/var/www/config/config.php";
$site_config = new SiteConfig();

//processes form data
require_once "/var/www/login/login.php";
//packaged seperately to make this file less ugly, this page is dependant on the other.
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo $site_config->site_title; ?></title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div id=header>
		<h1>Welcome to <?php echo $site_config->site_title; ?></h1>
	</div>
	<div id="login-register">
		<div class="form column" id=register>
			<center>
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id=reg>
				<h3>Register</h3>
				<label>Username</label><br>
				<label class=formhint>a-Z, 0-9, - and _</label><br>
				<input class=box type="text" name="username" required><br><br>
				<label>Password</label><br>
				<label class=formhint>&nbsp;</label><br>
				<input class=box type="password"  name="password" required><br>
				<label>E-mail</label><br>
				<label class=formhint>We won't send you spam.</label><br>
				<input class=box type="email"  name="email" required><br>
				<input type="submit" name="register" value="register"><br>
				<label class=errorlabel><?php if(isset($reg_error)) { echo "$reg_error"; } ?></label>
			</form>
			</center>
		</div>
		<div class="form column" id=login>
			<center>
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id=log>
				<h3>Already have an account?</h3>
				<h3>Login</h3>
				<label>Username</label><br>
				<label class=formhint>&nbsp;</label><br>
				<input class=box type="text" name="username" required><br><br>
				<label>Password</label><br>
				<label class=formhint>&nbsp;</label><br>
				<input class=box type="password" name="password" required><br>
				<input type="submit" name="login" value="login">
				<label class=errorlabel><?php if(isset($login_error)) { echo "$login_error"; } ?></label>
			</form>
			</center>
		</div>

	</div>
</body>
</html>