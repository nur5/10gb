<?php

class Order implements \JsonSerializable {
    private $id;
    private $address;
    private $paymentdetails;
    private $items;
    private $status;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
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

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function getItems() {
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }
}
?>