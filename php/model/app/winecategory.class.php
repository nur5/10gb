<?php

class WineCategory implements \JsonSerializable {
    private $id;
    private $category;
    private $subcategory;

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

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function getSubcategory() {
        return $this->subcategory;
    }

    public function setSubcategory($subcategory) {
        $this->subcategory = $subcategory;
        return $this;
    }
}
?>