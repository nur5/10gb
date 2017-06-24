<?php
require_once 'controller.php';
require_once 'usercontroller.php';
require_once 'customercontroller.php';
require_once 'winecontroller.php';
require_once __DIR__ . '/../model/api/newadmin.class.php';
require_once __DIR__ . '/../model/api/newwine.class.php';

class AdminController extends Controller {
    private $custcontrol;

    public function __construct() {
        parent::__construct();
        $this->custcontrol = new CustomerController();
    }

    public static function uploadImage($_files) {
        $targetDir = dirname(dirname(__DIR__)) . '/uploads/';
        if ($_files['wine']['error'] == 0) {
            $fn = $_files['wine']['name'];
            $url = $targetDir . $fn;
            if (is_file($url)) {
                $old = $fn;
                $pos = strrpos($old, '.');
                $fn = substr($old, 0, $pos) . '1' . substr($old, $pos);
                $url = $targetDir . $fn;
            }
            if (move_uploaded_file($_files['wine']['tmp_name'], $url)) {
                return $fn;
            }
        }
        return null;
    }

    public function makeWine($req) {
        $nova = new NewWine($req);
        return $this->dao->makeWine($nova);
    }

    public function makeAdmin($req) {
        $dadmin = new NewAdmin($req);
        return $this->dao->makeUser($dadmin, 'admin');
    }

    public function getCustomers() {
        return $this->custcontrol->getCustomers();
    }
}