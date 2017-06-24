<?php
require_once __DIR__ . '/../model/api/neworder.class.php';

class OrderController extends Controller {

    public function makeNewOrder($req) {
        $nova = new NewOrder($req);
        return $this->dao->makeNewOrder($nova);
    }

    public function getCustomerOrdersById($id) {}

    public function getCustomerOrderById($cid, $id) {}
}