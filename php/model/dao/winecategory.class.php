<?php

class DWineCategory {
    private $winecategoryid;
    private $category;
    private $subcategory;

    public function getWinecategoryid() {
        return $this->winecategoryid;
    }

    public function setWinecategoryid($winecategoryid) {
        $this->winecategoryid = $winecategoryid;
        return $this;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
        return $this;
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
