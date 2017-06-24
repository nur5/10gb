<?php
class DAddress {
	private $addressid;
	private $customerid;
	private $address;
	private $postcode;

	public function getAddressid() {
		return $this->addressid;
	}

	public function setAddressid($addressid) {
		$this->addressid = $addressid;
		return $this;
	}

	public function getCustomerid() {
		return $this->customerid;
	}

	public function setCustomerid($customerid) {
		$this->customerid = $customerid;
		return $this;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	public function getPostcode() {
		return $this->postcode;
	}

	public function setPostcode($postcode) {
		$this->postcode = $postcode;
		return $this;
	}
}
?>
