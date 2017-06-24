<?php

class Item implements \JsonSerializable {
    private $id;
    private $wine;
    private $caseorbottle;
    private $quantity;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getWine() {
        return $this->wine;
    }

    public function setWine($wine) {
        $this->wine = $wine;
        return $this;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function getCaseorbottle() {
        return $this->caseorbottle;
    }

    public function setCaseorbottle($caseorbottle) {
        $this->caseorbottle = $caseorbottle;
        return $this;
    }
}
?>