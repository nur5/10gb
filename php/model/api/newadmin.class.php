<?php
class NewAdmin {
	private $username;
	private $password;
	private $emailaddress;

	public function __construct($json) {
		$arr = json_decode($json, true);
		foreach($arr as $key => $value) {
			$this->{$key} = $value;
		}
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

	public function getEmailaddress() {
		return $this->emailaddress;
	}

	public function setEmailaddress($emailaddress) {
		$this->emailaddress = $emailaddress;
		return $this;
	}
}
?>