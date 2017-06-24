<?php
require_once 'controller.php';
require_once 'usercontroller.php';
require_once __DIR__ . '/../model/api/newaddress.class.php';

class CustomerController extends Controller {

    public function getCustomers() { // with orders
        return $this->dao->getCustomers();
    }

    public function getCustomerById($id) {
        return $this->dao->getCustomerById($id);
    }

    public function createAddress($req) {
        $nova = new NewAddress($req);
        return $this->dao->makeCustomerAddress($nova);
    }
}
?>