<?php

class DWine {
    private $wineid;
    private $winecategoryid;
    private $name;
    private $description;
    private $country;
    private $price_bottle;
    private $price_case;
    private $bottle_size;
    private $bottles_per_case;
    private $bottles_left;
    private $cases_left;
    private $img;

    public function getWineid() {
        return $this->wineid;
    }

    public function setWineid($wineid) {
        $this->wineid = $wineid;
        return $this;
    }

    public function getWinecategoryid() {
        return $this->winecategoryid;
    }

    public function setWinecategoryid($winecategoryid) {
        $this->winecategoryid = $winecategoryid;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function getPriceBottle() {
        return $this->price_bottle;
    }

    public function setPriceBottle($price_bottle) {
        $this->price_bottle = $price_bottle;
        return $this;
    }

    public function getPriceCase() {
        return $this->price_case;
    }

    public function setPriceCase($price_case) {
        $this->price_case = $price_case;
        return $this;
    }

    public function getBottleSize() {
        return $this->bottle_size;
    }

    public function setBottleSize($bottle_size) {
        $this->bottle_size = $bottle_size;
        return $this;
    }

    public function getBottlesPerCase() {
        return $this->bottles_per_case;
    }

    public function setBottlesPerCase($bottles_per_case) {
        $this->bottles_per_case = $bottles_per_case;
        return $this;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

    public function getBottlesLeft() {
        return $this->bottles_left;
    }

    public function setBottlesLeft($bottles_left) {
        $this->bottles_left = $bottles_left;
        return $this;
    }

    public function getCasesLeft() {
        return $this->cases_left;
    }

    public function setCasesLeft($cases_left) {
        $this->cases_left = $cases_left;
        return $this;
    }
}
?>
