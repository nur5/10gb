<?php
require_once 'wine.class.php';
require_once 'user.class.php';
require_once 'customer.class.php';
require_once 'winecategory.class.php';
require_once 'order.class.php';
require_once 'orderitem.class.php';
require_once 'address.class.php';
require_once 'shoppingbasket.class.php';
require_once 'shoppingbasketitem.class.php';
require_once __DIR__ . '/../app/wine.class.php';
require_once __DIR__ . '/../app/order.class.php';
require_once __DIR__ . '/../app/address.class.php';
require_once __DIR__ . '/../app/item.class.php';
require_once __DIR__ . '/../app/shoppingbasket.class.php';
require_once __DIR__ . '/../app/user.class.php';
require_once __DIR__ . '/../app/customer.class.php';
require_once __DIR__ . '/../api/mockbasketresp.class.php';

// late static binding magic:
class Singleton {
    protected static $instance = null;

    protected function __construct() {}

    protected function __clone() {}

    public static function instance() {
        if (! isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}

class Dao extends Singleton {
    private $pdo;

    protected function __construct() {
        $vendor = "mysql";
        $server = "127.0.0.1";
        $dbname = "id1206621_10gb";
        $username = "id1206621_10gb";
        $password = "cantthinkofone";
        // $dbname = "10gb";
        // $username = "dev";
        // $password = "devpassword";
        
        $this->pdo = new PDO("$vendor:host=$server;dbname=$dbname;charset=utf8", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function mapBasket(DShoppingBasket $basket) {
        $bskt = new ShoppingBasket();
        $bskt->setId((int) $basket->getShoppingbasketid());
        return $bskt->setItems($this->getBasketItemsById($basket->getShoppingbasketid()));
    }

    private function mapUser(DUser $duser) {
        $user = new User();
        $user->setId((int) $duser->getUserId());
        $user->setUsername($duser->getUsername());
        $user->setPassword($duser->getPassword());
        return $user->setEmailaddress($duser->getEmailaddress());
    }

    private function mapCustomer($dcustomer) {
        $customer = new Customer();
        $customer->setId((int) $dcustomer->getCustomerId());
        $customer->setFirstName($dcustomer->getFirstName());
        $customer->setLastName($dcustomer->getLastName());
        $customer->setUser($this->getUserById($dcustomer->getUserId()));
        $customer->setOrders($this->getCustomerOrders($customer));
        $customer->setBasket($this->getCustomerBasketById($customer->getId()));
        return $customer->setAddresses($this->getCustomerAdresses($customer));
    }

    private function mapWineCat(DWineCategory $dwinecat) {
        $winecat = new WineCategory();
        $winecat->setId((int) $dwinecat->getWinecategoryid());
        $winecat->setCategory($dwinecat->getCategory());
        return $winecat->setSubcategory($dwinecat->getSubcategory());
    }

    private function mapWine(DWine $dwine) {
        $wine = new Wine();
        $wine->setId((int) $dwine->getWineid());
        $wine->setCategory($this->getWineCategoryById($dwine->getWinecategoryid()));
        $wine->setName($dwine->getName());
        $wine->setDescription($dwine->getDescription());
        $wine->setCountry($dwine->getCountry());
        $wine->setBottlesize((int) $dwine->getBottlesize());
        $wine->setBottlescase((int) $dwine->getBottlespercase());
        $wine->setPriceBottle((float) $dwine->getPriceBottle());
        $wine->setPricecase((float) $dwine->getPriceCase());
        $wine->setImg($dwine->getImg());
        $wine->setBottlesleft((int) $dwine->getBottlesLeft());
        return $wine->setCasesleft((int) $dwine->getCasesLeft());
    }

    private function mapOrder(DOrder $dorder) {
        $order = new Order();
        $order->setId((int) $dorder->getOrderid());
        $order->setAddress($this->getAddressById($dorder->getAddressid()));
        $order->setPaymentdetails($dorder->getPaymentdetails());
        $order->setStatus($dorder->getStatus());
        return $order->setItems($this->getOrderItems($order));
    }

    private function mapBasketItem(DShoppingBasketItem $item) {
        $itm = new Item();
        $itm->setId((int) $item->getShoppingbasketitemid());
        $itm->setWine($this->getWineById($item->getWineid()));
        $itm->setQuantity((int) $item->getQuantity());
        return $itm->setCaseorbottle($item->getCaseorbottle());
    }

    private function mapOrderItem(DOrderItem $dord) {
        $ord = new Item();
        $ord->setId((int) $dord->getOrderitemid());
        $ord->setCaseorbottle($dord->getCaseorbottle());
        $ord->setQuantity($dord->getQuantity());
        return $ord->setWine($this->getWineById($dord->getWineid()));
    }

    private function mapAddress(DAddress $dad) {
        $add = new Address();
        $add->setId((int) $dad->getAddressid());
        $add->setAddress($dad->getAddress());
        return $add->setPostcode($dad->getPostcode());
    }

    private function getUserCustomer($id) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM customers WHERE userid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DCustomer');
            $cust = $stt->fetch();
            return $this->mapCustomer($cust);
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    private function getCustomerOrders(Customer $cust) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM orders WHERE orders.customerid=:id");
            $stt->bindValue(":id", $cust->getId());
            $stt->execute();
            $dorders = $stt->fetchAll(PDO::FETCH_CLASS, 'DOrder');
            $orders = [];
            foreach ($dorders as $order) {
                $orders[] = $this->mapOrder($order);
            }
            return $orders;
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    private function getCustomerAdresses(Customer $cust) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM addresses WHERE addresses.customerid=:id");
            $stt->bindValue(":id", $cust->getId());
            $stt->execute();
            $dads = $stt->fetchAll(PDO::FETCH_CLASS, 'DAddress');
            $adds = [];
            foreach ($dads as $ad) {
                $adds[] = $this->mapAddress($ad);
            }
            return $adds;
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    private function getOrderItems(Order $order) {
        try {
            $stt = $this->pdo->prepare("SELECT * from orderitems WHERE orderitems.orderid=:id");
            $stt->bindValue(":id", $order->getId());
            $stt->execute();
            $dords = $stt->fetchAll(PDO::FETCH_CLASS, 'DOrderItem');
            $ords = [];
            foreach ($dords as $d) {
                $ords[] = $this->mapOrderItem($d);
            }
            return $ords;
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function createNewBasketById($id) {
        try {
            $stt = $this->pdo->prepare("INSERT INTO shoppingbaskets VALUES (NULL,:id)");
            $stt->bindValue(":id", $id);
            $stt->execute();
            return $this->getBasketById($this->pdo->lastInsertId());
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function getCustomerBasketById($id) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM shoppingbaskets where customerid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DShoppingBasket');
            $basket = $stt->fetch();
            return $basket === false ? $this->createNewBasketById($id) : $this->mapBasket($basket);
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function getBasketById($id) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM shoppingbaskets where shoppingbasketid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DShoppingBasket');
            $basket = $stt->fetch();
            return $this->mapBasket($basket);
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function getBasketItemsById($id) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM shoppingbasketitems WHERE shoppingbasketid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $old = $stt->fetchAll(PDO::FETCH_CLASS, 'DShoppingBasketItem');
            $nou = [];
            foreach ($old as $itm) {
                $nou[] = $this->mapBasketItem($itm);
            }
            return $nou;
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function hasCustomerBasketById($id) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM shoppingbaskets where customerid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $row = $stt->fetch();
            return isset($row) ? true : false;
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function addItemToBasket($id, $wine, $quantity, $corb) {
        try {
            $stt = $this->pdo->prepare("INSERT INTO shoppingbasketitems VALUES (NULL,:id,:wid,:corb,:qua)");
            $stt->bindValue(":id", $id);
            $stt->bindValue(":wid", $wine);
            $stt->bindValue(":qua", $quantity);
            $stt->bindValue(":corb", $corb);
            $stt->execute();
            return $this->getBasketById($id);
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function addToBasket(ShoppingBasketRequest $req) {
        try {
            $id = $req->getCustomerid();
            if ($this->hasCustomerBasketById($id)) {
                $basket = $this->getCustomerBasketById($id);
                return $this->addItemToBasket($basket->getId(), $req->getWineid(), $req->getQuantity(), $req->getCaseorbottle());
            } else {
                $basket = $this->createNewBasketById($id);
                return $this->addItemToBasket($basket->getId(), $req->getWineid(), $req->getQuantity(), $req->getCaseorbottle());
            }
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function clearBasket(BasketClearReq $bskt) {
        try {
            $stt = $this->pdo->prepare("DELETE FROM shoppingbasketitems where shoppingbasketid=:id");
            $stt->bindValue(":id", $bskt->getId());
            $stt->execute();
            return $this->getBasketById($bskt->getId());
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function addToMockBasket(MockBasketReq $req) {
        $itm = new Item();
        $itm->setCaseorbottle($req->getCaseorbottle());
        $itm->setQuantity($req->getQuantity());
        $itm->setWine($this->getWineById($req->getWineid()));
        $resp = new MockBasketResp();
        $resp->setItems($req->getItems() == null ? [] : $req->getItems());
        $pengting = $resp->getItems();
        $pengting[] = $itm;
        return $resp->setItems($pengting);
    }

    public function deleteWineById($id) {
        try {
            $ret = $this->getWineById($id);
            $stt = $this->pdo->prepare("DELETE FROM wines WHERE wines.wineid=:id");
            $stt->bindValue(':id', $id);
            $stt->execute();
            return $ret;
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function updateWine(UpdateWine $wine) {
        try {
            $stt = $this->pdo->prepare("UPDATE wines SET name=:name, description=:desc, country=:country,
price_bottle=:pb, price_case=:pc, bottle_size=:bs, bottles_per_case=:bc,img=:img, bottles_left=:bl, cases_left=:cl
WHERE wineid=:id");
            $stt->bindValue(":name", $wine->getName());
            $stt->bindValue(":desc", $wine->getDescription());
            $stt->bindValue(":country", $wine->getCountry());
            $stt->bindValue(":pb", $wine->getPriceBottle());
            $stt->bindValue(":pc", $wine->getPriceCase());
            $stt->bindValue(":bs", $wine->getBottleSize());
            $stt->bindValue(":bc", $wine->getBottlesPerCase());
            $stt->bindValue(":img", $wine->getImg());
            $stt->bindValue(":bl", $wine->getBottlesLeft());
            $stt->bindValue(":cl", $wine->getCasesLeft());
            $stt->bindvalue(":id", $wine->getId());
            $stt->execute();
            return $this->getWineById($wine->getId());
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function makeOrderItems($items, $id) {
        try {
            $stt = $this->pdo->prepare("INSERT INTO orderitems VALUES (NULL,:od,:wi,:corb,:qu)");
            foreach ($items as $item) {
                $stt->bindValue(":od", $id);
                $stt->bindValue(":wi", $item["wine"]["id"]);
                $stt->bindValue(":corb", $item["caseorbottle"]);
                $stt->bindValue(":qu", $item["quantity"]);
                $stt->execute();
            }
            return $this->getOrderById($id);
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    private function getOrderById($id) {
        try {
            $stt = $this->pdo->prepare('
    SELECT * FROM orders WHERE orderid = :id');
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DOrder');
            return $this->mapOrder($stt->fetch());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function makeNewOrder(NewOrder $ord) {
        try {
            $stt = $this->pdo->prepare("INSERT INTO orders VALUES (NULL,:cid,:aid,:pd,:sts)");
            $stt->bindValue(":cid", $ord->getCustomerid());
            $stt->bindValue(":aid", $ord->getAddressid());
            $stt->bindValue(":pd", $ord->getPaymentdetails());
            $stt->bindValue(":sts", "D");
            $stt->execute();
            return $this->makeOrderItems($ord->getItems(), $this->pdo->lastInsertId());
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function makeWine(NewWine $wine) {
        try {
            $stt = $this->pdo->prepare('INSERT INTO wines VALUES(NULL,:catid,:name,:description,:country,:pb,:pc,:bs,:bc,:img,:bl,:cl)');
            $ball = '5';
            switch ($wine->getCat()) {
                case '1':
                    if ($wine->getSubcat() === '3')
                        $ball = '1';
                    else if ($wine->getSubcat() === '4')
                        $ball = '2';
                    break;
                case '2':
                    if ($wine->getSubcat() === '1')
                        $ball = '4';
                    else if ($wine->getSubcat() === '2')
                        $ball = '3';
                    break;
                case '3':
                    $ball = '5';
                    break;
            }
            $stt->bindValue(":catid", $ball);
            $stt->bindValue(":name", $wine->getName());
            $stt->bindValue(":description", $wine->getDescription());
            $stt->bindValue(":country", $wine->getCountry());
            $stt->bindValue(":pb", $wine->getPriceBottle());
            $stt->bindValue(":pc", $wine->getPriceCase());
            $stt->bindValue(":bs", $wine->getBottleSize());
            $stt->bindValue(":bc", $wine->getBottlesPerCase());
            $stt->bindValue(":img", $wine->getImg());
            $stt->bindValue(":bl", $wine->getBottlesLeft());
            $stt->bindValue(":cl", $wine->getCasesLeft());
            $stt->execute();
            return $this->getWineById($this->pdo->lastInsertId());
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function getWines() {
        try {
            $stt = $this->pdo->query('
    SELECT * FROM wines');
            $stt->execute();
            $wines = $stt->fetchAll(PDO::FETCH_CLASS, 'DWine');
            $kines = [];
            foreach ($wines as $wine) {
                $kines[] = $this->mapWine($wine);
            }
            return $kines;
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function getWineById($id) {
        try {
            $stt = $this->pdo->prepare('
    SELECT * FROM wines WHERE wineid = :id');
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DWine');
            return $this->mapWine($stt->fetch());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function makeUser($user, $role) {
        try {
            $stt = $this->pdo->prepare("
				INSERT INTO users (username,password,emailaddress,role) VALUES
				(:username,:password,:email,:role)");
            $stt->bindValue(":username", $user->getUsername());
            $stt->bindValue(":password", md5($user->getPassword()));
            $stt->bindValue(":email", $user->getEmailaddress());
            $stt->bindValue(":role", $role);
            $stt->execute();
            return $this->getUserById($this->pdo->lastInsertId());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getUsers() {
        try {
            $stt = $this->pdo->query("
				SELECT * FROM users WHERE role='user'");
            $stt->execute();
            $dusers = $stt->fetchAll(PDO::FETCH_CLASS, 'DUser');
            $users = [];
            foreach ($dusers as $user) {
                $users[] = $this->mapUser($user);
            }
            return $users;
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getUserById($id) {
        try {
            $stt = $this->pdo->prepare('
				SELECT * FROM users WHERE userid=:id');
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DUser');
            $us = $stt->fetch();
            return $this->mapUser($us);
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function makeCustomer($cust) {
        try {
            $stt = $this->pdo->prepare("
					INSERT INTO customers (firstname,lastname,userid) VALUES
					(:firstname,:lastname,:userid)");
            $stt->bindValue(":firstname", $cust->getFirstname());
            $stt->bindValue(":lastname", $cust->getLastname());
            $stt->bindValue(":userid", $cust->getUserid());
            $stt->execute();
            return $this->getCustomerById($this->pdo->lastInsertId());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function makeCustomerAddress(NewAddress $add) {
        try {
            $stt = $this->pdo->prepare("INSERT INTO addresses VALUES(NULL,:cid,:add,:post)");
            $stt->bindValue(":cid", $add->getCustomerid());
            $stt->bindValue(":add", $add->getAddress());
            $stt->bindValue(":post", "LM4A0");
            $stt->execute();
            return $this->getAddressById($this->pdo->lastInsertId());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getCustomers() {
        try {
            $stt = $this->pdo->prepare('
				SELECT * FROM customers');
            $stt->execute();
            $dcustomers = $stt->fetchAll(PDO::FETCH_CLASS, 'DCustomer');
            $customers = [];
            foreach ($dcustomers as $customer) {
                $customers[] = $this->mapCustomer($customer);
            }
            return $customers;
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getCustomerById($id) {
        try {
            $stt = $this->pdo->prepare('
				SELECT * FROM customers WHERE customerid=:id');
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DCustomer');
            return $this->mapCustomer($stt->fetch());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getWineCategories() {
        try {
            $stt = $this->pdo->query("
     		SELECT * FROM winecategories");
            $stt->execute();
            $dwinecats = $stt->fetchAll(PDO::FETCH_CLASS, "DWineCategory");
            $winecats = [];
            foreach ($dwinecats as $d) {
                $winecats[] = $this->mapWineCat($d);
            }
            return $winecats;
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function login(LoginReq $req) {
        try {
            $stt = $this->pdo->prepare("SELECT * FROM users WHERE username=:usn");
            $stt->bindValue(":usn", $req->getUsn());
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DUser');
            $usr = $stt->fetch();
            if (! isset($usr)) {
                return 'UFAIL';
            } else if (md5($req->getPw()) == $usr->getPassword()) {
                return $this->getUserCustomer($usr->getUserId());
            } else {
                return 'FAIL';
            }
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getWineCategoryById($id) {
        try {
            $stt = $this->pdo->prepare("
      	SELECT * FROM winecategories WHERE winecategoryid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, "DWineCategory");
            $wc = $stt->fetch();
            return $this->mapWineCat($wc);
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }

    public function getAddresses() {
        try {
            $stt = $this->pdo->query('SELECT * FROM addresses');
            $stt->execute();
            $dads = $stt->fetchAll(PDO::FETCH_CLASS, 'DAddress');
            $ads = [];
            foreach ($dads as $da) {
                $ads[] = $this->mapAddress($da);
            }
            return $ads;
        } catch (PDOException $ex) {
            return 'Error ' . $ex->getMessage();
        }
    }

    public function getAddressById($id) {
        try {
            $stt = $this->pdo->prepare("
      	SELECT * FROM addresses WHERE addressid=:id");
            $stt->bindValue(":id", $id);
            $stt->execute();
            $stt->setFetchMode(PDO::FETCH_CLASS, 'DAddress');
            return $this->mapAddress($stt->fetch());
        } catch (PDOException $ex) {
            return "Error " . $ex->getMessage();
        }
    }
}
?>
