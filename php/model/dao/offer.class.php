<?php
class DOffer {
	private $offerid;
	private $discountvalue;
	private $caseorbottle;
	private $startdate;
	private $enddate;

	public function getOfferid() {
		return $this->offerid;
	}

	public function setOfferid($id) {
		$this->offerid = $id;
		return $this;
	}

	public function getDiscountvalue() {
		return $this->discountvalue;
	}

	public function setDiscountvalue($discountvalue) {
		$this->discountvalue = $discountvalue;
		return $this;
	}

	public function getCaseorbottle() {
		return $this->caseorbottle;
	}

	public function setCaseorbottle($caseorbottle) {
		$this->caseorbottle = $caseorbottle;
		return $this;
	}

	public function getStartdate() {
		return $this->startdate;
	}

	public function setStartdate($startdate) {
		$this->startdate = $startdate;
		return $this;
	}

	public function getEnddate() {
		return $this->enddate;
	}

	public function setEnddate($enddate) {
		$this->enddate = $enddate;
		return $this;
	}
}
?>