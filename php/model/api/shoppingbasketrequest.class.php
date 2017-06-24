<?php

class ShoppingBasketRequest {
    private $wineid;
    private $quantity;
    private $caseorbottle;
    private $customerid;

    public function __construct($json) {
        $arr = json_decode($json, true);
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getWineid() {
        return $this->wineid;
    }

    public function setWineid($wineid) {
        $this->wineid = $wineid;
        return $this;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    public function getCaseorbottle() {
        return $this->caseorbottle;
    }

    public function setCaseorbottle($caseorbottle) {
        $this->caseorbottle = $caseorbottle;
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