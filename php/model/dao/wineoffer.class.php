<?php
class DWineOffer {
	private $wineofferid;
	private $wineid;

	public function getWineofferid() {
		return $this->wineofferid;
	}

	public function setWineofferid($wineofferid) {
		$this->wineofferid = $wineofferid;
		return $this;
	}

	public function getWineid() {
		return $this->wineid;
	}

	public function setWineid($wineid) {
		$this->wineid = $wineid;
		return $this;
	}
}
?>
