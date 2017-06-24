<?php
require_once 'controller.php';
require_once __DIR__ . '/../model/api/shoppingbasketrequest.class.php';
require_once __DIR__ . '/../model/api/mockbasketreq.class.php';
require_once __DIR__ . '/../model/api/basketclearreq.class.php';

class BasketController extends Controller {

    public function addToBasket($req) {
        $nova = new ShoppingBasketRequest($req);
        return $this->dao->addToBasket($nova);
    }

    public function addToMockBasket($req) {
        $nova = new MockBasketReq($req);
        return $this->dao->addToMockBasket($nova);
    }

    public function clearBasket($bskt) {
        $nova = new BasketClearReq($bskt);
        return $this->dao->clearBasket($nova);
    }
}
?>