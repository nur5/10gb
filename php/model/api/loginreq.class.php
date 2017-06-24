<?php

class LoginReq {
    private $usn;
    private $pw;

    public function __construct($json) {
        $arr = json_decode($json, true);
        foreach ($arr as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getUsn() {
        return $this->usn;
    }

    public function setUsn($usn) {
        $this->usn = $usn;
        return $this;
    }

    public function getPw() {
        return $this->pw;
    }

    public function setPw($pw) {
        $this->pw = $pw;
        return $this;
    }
}
?>