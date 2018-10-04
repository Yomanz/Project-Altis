<?php
$configFile = "config.php";
class UserDBClass {
	
	public function __construct($configArg="") {
		if($configArg != "") { // an argument was provided
			try { // make sure config file works
				include	"$configArg";
				$this->conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
			} catch(Exception $e) {
				exit("Provided configArg caused an error: $e");
				exit();
			}
		} elseif(isset($_GLOBAL["configFile"])) { // no argument provided but a global setting exists
				try { // make sure global config file works
					include	"$configArg";
					$this->conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
				} catch(Exception $e) {
					exit("Global configFile caused an error: $e");
				}
		} else { //no config files found, throw exception
			throw new Exception('Global configFile not set and no configArg was provided as a constructor argument');
		}

	} // end constructor

	public function username_exists($username) {
		//if user exists, return True
		///  need seperate function to clean input, possibly in another more universal utilityClass or as a global function  ///
		//build sql query
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
		//need function to clean input, as above
		//build sql query
		$sql = "SELECT * FROM users WHERE `email` = '$email' LIMIT 1";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			return True;
		} else {
			return False;
		}
	}



	public function create($username, $email, $pass) {
		echo $username;
		echo $pass;
		echo $email;

		//Returns True if successful and False on fail
		$username = mysqli_real_escape_string($this->conn,$username);
		$email = mysqli_real_escape_string($this->conn,$email);
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
}
// tests vvvvv

?>
