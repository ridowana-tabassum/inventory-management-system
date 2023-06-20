<?php

/**
* User Class for account creation and login pupose
*/
class User
{
	
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	//User is already registered or not
	private function emailExists($email){
		$pre_stmt = $this->con->prepare("SELECT id FROM user WHERE email = ? ");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0){
			return 1;
		}else{
			return 0;
		}
	}

	public function createUserAccount($username,$email,$password,$usertype){
		//To protect your application from sql attack you can user 
		//prepares statment
		if ($this->emailExists($email)) {
			return "EMAIL_ALREADY_EXISTS";
		}else{
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$pre_stmt = $this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`)
			 VALUES (?,?,?,?)");
			$pre_stmt->bind_param("ssss",$username,$email,$pass_hash,$usertype);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return $this->con->insert_id;
			}else{
				return "SOME_ERROR";
			}
		}
			
	}

	public function userLogin($email,$password){
		$pre_stmt = $this->con->prepare("SELECT id,username,password FROM user WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERD";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
				$_SESSION["userid"] = $row["id"];
				$_SESSION["username"] = $row["username"];

			}else{
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

}


?>