<?php

class Customer implements \JsonSerializable {
    private $id;
    private $firstname;
    private $lastname;
    private $orders;
    private $addresses;
    private $basket;
    private $user;

    public function getFullName() {
        return "$this->firstname $this->lastname";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function getOrders() {
        return $this->orders;
    }

    public function setOrders($orders) {
        $this->orders = $orders;
        return $this;
    }

    public function getAddresses() {
        return $this->addresses;
    }

    public function setAddresses($addresses) {
        $this->addresses = $addresses;
        return $this;
    }

    public function getBasket() {
        return $this->basket;
    }

    public function setBasket($basket) {
        $this->basket = $basket;
        return $this;
    }
}
?>