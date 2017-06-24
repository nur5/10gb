<?php

class MockBasketResp implements \JsonSerializable {
    private $items;

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