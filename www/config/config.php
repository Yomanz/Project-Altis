<?php

class SiteConfig {
	function __construct() {
		$this->site_title = "Project Altis";
	}
}

class DBConfig {
	function __construct() {
		$this->DBName = "Altis";
		$this->DBUser = "root";
		$this->DBPass = "REDACTED";
		$this->DBServer = "localhost";
	}
}

?>