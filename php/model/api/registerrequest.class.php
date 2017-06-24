<?php
class RegisterRequest {
	private $firstname;
	private $lastname;
	private $emailaddress;
	private $username;
	private $password;

	public function __construct($json) {
		$arr = json_decode($json, true);
		foreach($arr as $key => $value) {
			$this->{$key} = $value;
		}
	}

	public function getFirstname() {
		return $this->firstname;
	}

	public function setFirstname($firstname) {
		$this->firstname = $firstname;
		return $this;
	}

	public function getLastname() {
		return $this->lastname;
	}

	public function setLastname($lastname) {
		$this->lastname = $lastname;
		return $this;
	}

	public function getEmailaddress() {
		return $this->emailaddress;
	}

	public function setEmailaddress($emailaddress) {
		$this->emailaddress = $emailaddress;
		return $this;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
		return $this;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}
}
?>