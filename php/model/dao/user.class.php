<?php
class DUser {
	private $userid;
	private $username;
	private $password;
	private $emailaddress;
	private $role;

	public function getUserid() {
		return $this->userid;
	}

	public function setUserid($userid) {
		$this->userid = $userid;
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

	public function getRole() {
		return $this->role;
	}

	public function setRole($role) {
		$this->role = $role;
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