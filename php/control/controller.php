<?php
require_once __DIR__ . '/../model/dao/dao.php';

class Controller
{

    protected $dao;

    function __construct()
    {
        $this->dao = Dao::instance();
    }
}
?>