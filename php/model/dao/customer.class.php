<?php
class DCustomer {
	private $customerid;
	private $firstname;
	private $lastname;
	private $userid;

	public function getCustomerid() {
		return $this->customerid;
	}

	public function setCustomerid($customerid) {
		$this->customerid = $customerid;
		return $this;
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

	public function getUserid() {
		return $this->userid;
	}

	public function setUserid($userid) {
		$this->userid = $userid;
		return $this;
	}
}
?>
