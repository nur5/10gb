<?php

class NewAddress {
    private $address;
    private $customerid;

    public function __construct($json) {
        $arr = json_decode($json, true);
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
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