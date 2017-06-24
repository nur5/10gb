<?php
require_once 'controller.php';
require_once __DIR__ . '/../model/api/updatewine.class.php';

class WineController extends Controller {

    public function getWines() {
        return $this->dao->getWines();
    }

    public function getWineById($id) {
        return $this->dao->getWineById($id);
    }

    public function delWineById($id) {
        return $this->dao->deleteWineById($id);
    }

    public function updateWine($whine) {
        $nova = new UpdateWine($whine);
        return $this->dao->updateWine($nova);
    }
}
?>