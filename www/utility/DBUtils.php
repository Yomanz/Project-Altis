<?php
require_once "/var/www/config/config.php";


class UserDBUtils {
	public function __construct() {
		$DBconfig = new DBConfig();
		try { // make sure config works and create $this->conn
			$this->conn = new mysqli($DBConfig->DBServer, $DBConfig->DBUser, $DBConfig->DBPass, $DBConfig->DBName);
		} catch(Exception $e) {
			exit("Config error: $e");
		}
	} // end constructor

	public function __destruct() {
	$this->conn->close();
	}

	public function clean_text($text) {
		$text = $this->conn->mysqli_real_escape_string($text);
		return $text;
	}

	public function username_exists($username) {
		//if user exists, return True
		$username = $this->clean_input($username);
		$sql = "SELECT * FROM users WHERE `username` = '$username'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			return True;
		} else {
			return False;
		}
	}

	public function email_exists($email) {
		//if email exists, return True
		$email = $this->clean_input($email);
		$sql = "SELECT * FROM users WHERE `email` = '$email' LIMIT 1";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			return True;
		} else {
			return False;
		}
	}


	public function create($username, $email, $pass) {
		//Ensures input is MySQL safe, hashes password,
		//Returns True if successful and False on fail
		//Does not check for correct email formatting
		$username = mysqli_real_escape_string($this->conn,$username);
		$email = mysqli_real_escape_string($this->conn,$email);
		$pass = mysqli_real_escape_string($this->conn,$pass);
		echo "cleanusr: $username";
		//need a function to test emails are actually emails, I have this in another project somewhere
		if($this->email_exists($email) or $this->username_exists($username)) {
			return False;
		} else {
			$hash = password_hash("$pass",PASSWORD_DEFAULT);
			$username = $username;
			$sql = "INSERT INTO `users` (`username`, `email`, `password_hash`) VALUES ('$username', '$email', '$hash')";
			echo "$sql";
			$result = $this->conn->query($sql);
			return True;
		}
	}

	public function destroy($username, $email, $pass) {
		//This is a one-way trip be careful
		//expand on this when more tables dependant on having a related user are made. e.g. "players"
		$username = mysqli_real_escape_string($this->conn,$username);
		$email = mysqli_real_escape_string($this->conn,$email);
		$pass = mysqli_real_escape_string($this->conn,$pass);
		//check username exists
		if(username_exists($username)) {
			$sql = "SELECT * FROM `users` WHERE `username` = $username LIMIT 1"; 
			$result = $this->conn->query($sql);
			if($result != False) {
				$row = $result->assoc_array();
				if($password_verify($pass, $row['password_hash'])) {
					// DELETE THE ACCOUNT 
					// AND ASSOCIATED ROWS
				} else {
					return False;
				}
			}
		} else {
			return False;
		}

	}
}


class PlayerDBUtils {
	public function __construct() {
		$DBconfigp = new DBConfig();
		try { // make sure config works and create $this->conn
			$this->conn = new mysqli($DBConfigp->DBServer, $DBConfigp->DBUser, $DBConfigp->DBPass, $DBConfigp->DBName);
		} catch(Exception $e) {
			exit("Config error: $e");
		}
	} // end constructor

	public function __destruct() {
		$this->conn->close();
	}


}
?>