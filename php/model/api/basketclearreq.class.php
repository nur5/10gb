<?php

class BasketClearReq {
    private $id;
    private $items;

    public function __construct($json) {
        $arr = json_decode($json, true);
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getItems() {
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }
}