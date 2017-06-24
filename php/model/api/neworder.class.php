<?php

class NewOrder {
    private $customerid;
    private $addressid;
    private $items;
    private $paymentdetails;

    public function __construct($json) {
        $arr = json_decode($json, true);
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
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

    public function getItems() {
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    public function getPaymentdetails() {
        return $this->paymentdetails;
    }

    public function setPaymentdetails($paymentdetails) {
        $this->paymentdetails = $paymentdetails;
        return $this;
    }
}