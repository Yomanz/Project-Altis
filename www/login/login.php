<?php
// Handles login/registration forms from html/login/
//
// Expected login POST data names: "username", "password", //"coinhive-captcha-token"// to be considered
// Expected register POST data names: "username", "password", "email", //"coinhive-captcha-token"//
//

//provides Classes UserDBUtils, PlayerDBUtils

require_once "/var/www/utility/DBUtils.php";

$userUtils = new UserDBUtils();


$reg_error = "Registration not currently working";
$login_error = "Login not currently working";




?>
