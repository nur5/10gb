<?php
class DOrderItem {
	private $orderitemid;
	private $orderid;
	private $wineid;
	private $caseorbottle;
	private $quantity;
	public function getOrderitemid() {
		return $this->orderitemid;
	}
	public function setOrderitemid($orderitemid) {
		$this->orderitemid = $orderitemid;
		return $this;
	}
	public function getOrderid() {
		return $this->orderid;
	}
	public function setOrderid($orderid) {
		$this->orderid = $orderid;
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
