<?php
class DShoppingBasketItem {
	private $shoppingbasketitemid;
	private $shoppingbasketid;
	private $wineid;
	private $caseorbottle;
	private $quantity;

	public function getShoppingbasketitemid() {
		return $this->shoppingbasketitemid;
	}

	public function setShoppingbasketitemid($shoppingbasketitemid) {
		$this->shoppingbasketitemid = $shoppingbasketitemid;
		return $this;
	}

	public function getShoppingbasketid() {
		return $this->shoppingbasketid;
	}

	public function setShoppingbasketid($shoppingbasketid) {
		$this->shoppingbasketid = $shoppingbasketid;
		return $this;
	}

	public function getWineid() {
		return $this->wineid;
	}

	public function setWineid($wineid) {
		$this->wineid = $wineid;
		return $this;
	}

	public function getCaseorbottle() {
		return $this->caseorbottle;
	}

	public function setCaseorbottle($caseorbottle) {
		$this->caseorbottle = $caseorbottle;
		return $this;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function setQuantity($quantity) {
		$this->quantity = $quantity;
		return $this;
	}
}
?>
