<?php
require_once 'controller.php';
require_once __DIR__ . '/../model/dao/customer.class.php';
require_once __DIR__ . '/../model/api/registerrequest.class.php';
require_once __DIR__ . '/../model/api/loginreq.class.php';

class UserController extends Controller {

    public function getUsers() {
        return $this->dao->getUsers();
    }

    public function getUserById($id) {
        return $this->dao->getUserById($id);
    }

    public function registerUser($req) {
        $myRequest = new RegisterRequest($req);
        $dcustomer = new DCustomer();
        $dcustomer->setFirstname($myRequest->getFirstname());
        $dcustomer->setLastname($myRequest->getLastname());
        $duser = $this->dao->makeUser($myRequest, 'user');
        $dcustomer->setUserid($duser->getId());
        return $this->dao->makeCustomer($dcustomer);
    }

    public function login($req) {
        $nova = new LoginReq($req);
        return $this->dao->login($nova);
    }
}
?>