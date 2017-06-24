<?php
require_once 'winecategory.class.php';

class Wine implements \JsonSerializable {
    private $id;
    private $category;
    private $name;
    private $description;
    private $country;
    private $pricebottle;
    private $pricecase;
    private $bottlesize;
    private $bottlescase;
    private $casesleft;
    private $bottlesleft;
    private $img;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
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

    public function getBottlesize() {
        return $this->bottlesize;
    }

    public function setBottlesize($bottlesize) {
        $this->bottlesize = $bottlesize;
        return $this;
    }

    public function getBottlescase() {
        return $this->bottlescase;
    }

    public function setBottlescase($bottlescase) {
        $this->bottlescase = $bottlescase;
        return $this;
    }

    public function getPricebottle() {
        return $this->pricebottle;
    }

    public function setPricebottle($pricebottle) {
        $this->pricebottle = $pricebottle;
        return $this;
    }

    public function getPricecase() {
        return $this->pricecase;
    }

    public function setPricecase($pricecase) {
        $this->pricecase = $pricecase;
        return $this;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

    public function getCasesleft() {
        return $this->casesleft;
    }

    public function setCasesleft($casesleft) {
        $this->casesleft = $casesleft;
        return $this;
    }

    public function getBottlesleft() {
        return $this->bottlesleft;
    }

    public function setBottlesleft($bottlesleft) {
        $this->bottlesleft = $bottlesleft;
        return $this;
    }
}
?>