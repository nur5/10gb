<?php
class DOrder {
	private $orderid;
	private $customerid;
	private $addressid;
	private $paymentdetails;
	private $status;

	public function getOrderid() {
		return $this->orderid;
	}

	public function setOrderid($orderid) {
		$this->orderid = $orderid;
		return $this;
	}

	public function getCustomerid() {
		return $this->customerid;
	}

	public function setCustomerid($customerid) {
		$this->customerid = $customerid;
		return $this;
	}

	public function getAddressid() {
		return $this->addressid;
	}

	public function setAddressid($addressid) {
		$this->addressid = $addressid;
		return $this;
	}

	public function getPaymentdetails() {
		return $this->paymentdetails;
	}

	public function setPaymentdetails($paymentdetails) {
		$this->paymentdetails = $paymentdetails;
		return $this;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
}
?>
