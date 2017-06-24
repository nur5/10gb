<?php
class DShoppingBasket {
	private $shoppingbasketid;
	private $customerid;

	public function getShoppingbasketid() {
		return $this->shoppingbasketid;
	}

	public function setShoppingbasketid($shoppingbasketid) {
		$this->shoppingbasketid = $shoppingbasketid;
		return $this;
	}

	public function getCustomerid() {
		return $this->customerid;
	}

	public function setCustomerid($customerid) {
		$this->customerid = $customerid;
		return $this;
	}
}
?>
