<?php

class ShoppingBasket implements \JsonSerializable {
    private $id;
    private $items;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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