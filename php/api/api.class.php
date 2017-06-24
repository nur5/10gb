<?php
require_once 'ape.class.php';
require_once __DIR__ . '/../control/usercontroller.php';
require_once __DIR__ . '/../control/admincontroller.php';
require_once __DIR__ . '/../control/winecontroller.php';
require_once __DIR__ . '/../control/basketcontroller.php';
require_once __DIR__ . '/../control/customercontroller.php';
require_once __DIR__ . '/../control/ordercontroller.php';

class API extends Ape {
    private $usercontroller;
    private $admincontroller;
    private $winecontroller;
    private $basketcontroller;
    private $customercontroller;
    private $ordercontroller;

    function __construct($request) {
        parent::__construct($request);
        $this->usercontroller = new UserController();
        $this->admincontroller = new AdminController();
        $this->winecontroller = new WineController();
        $this->basketcontroller = new BasketController();
        $this->customercontroller = new CustomerController();
        $this->ordercontroller = new OrderController();
    }

    protected function register() {
        if ($this->method == 'POST') {
            return $this->usercontroller->registerUser($this->request);
        } else {
            return "Invalid method for register......";
        }
    }

    protected function orders() {
        if ($this->method == 'POST') {
            return $this->ordercontroller->makeNewOrder($this->request);
        }
    }

    protected function address() {
        if ($this->method == 'POST') {
            return $this->customercontroller->createAddress($this->request);
        } else {
            return 'INVALID METHOD FOR Create Address';
        }
    }

    protected function customers() {
        if ($this->method == 'GET') {
            if (is_numeric($this->args[0])) {
                return $this->customercontroller->getCustomerById($this->args[0]);
            }
        }
    }

    protected function login() {
        if ($this->method == 'POST') {
            return $this->usercontroller->login($this->request);
        } else {
            return "Invalid method for login......";
        }
    }

    protected function basket() {
        if ($this->method == 'POST') {
            if ($this->verb == 'clear') {
                return $this->basketcontroller->clearBasket($this->request);
            } else {
                return $this->basketcontroller->addToBasket($this->request);
            }
        }
    }

    protected function mockbasket() {
        if ($this->method == 'POST') {
            return $this->basketcontroller->addToMockBasket($this->request);
        }
    }

    protected function wines() {
        $id = $this->args[0];
        if ($this->method == 'GET') {
            if (is_numeric($id)) {
                return $this->winecontroller->getWineById($id);
            } else {
                return $this->winecontroller->getWines();
            }
        } else if ($this->method == 'DELETE') {
            if (is_numeric($id)) {
                return $this->winecontroller->delWineById($id);
            } else {
                return 'Cannot delete all wines because you want to!';
            }
        } else if ($this->method == 'PUT') {
            $putvars = [];
            parse_str($this->file, $putvars);
            return $this->winecontroller->updateWine($putvars);
        } else {
            return 'done fucked up for now.';
        }
    }

    protected function admin() {
        switch ($this->verb) {
            case 'upload':
                return AdminController::uploadImage($_FILES);
            case 'customers':
                return $this->admincontroller->getCustomers();
                break;
            case 'newadmin':
                if ($this->method != 'POST') {
                    return "Invalid method.....";
                } else {
                    return $this->admincontroller->makeAdmin($this->request);
                }
                break;
            case 'wines':
                if ($this->method == 'POST') {
                    return $this->admincontroller->makeWine($this->request);
                }
                break;
            default:
                return 'Ciao Davide';
        }
    }
}
?>
