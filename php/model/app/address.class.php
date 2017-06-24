<?php
class Address implements \JsonSerializable {
	private $id;
	private $address;
	private $postcode;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
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

	public function jsonSerialize() {
		return get_object_vars($this);
	}
}
?>
