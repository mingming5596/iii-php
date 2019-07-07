<?php

class Cart {
    private $list;

    function __construct() {
        session_start();

        $this->list = array();
    }

    function addProducts($pid, $qty) {
        if (!key_exists($pid, $this->list)) {
            $this->list[$pid] = $qty;
        }

        $_SESSION["shoppingCartInfo"] = $this->list;
    }

    function modifyProducts($pid, $qty) {
        if (key_exists($pid, $this->list)) {
            $this->list[$pid] = $qty;
        }
    }

    function removeProducts($pid) {
        if (key_exists($pid, $this->list)) {
            // $this->list[$pid] = $qty;
            unset($this->list[$pid]);
        }
    }

    function clearAll() {
        $this->list = array();
    }

    function getAll() {
        return $this->list;
    }

    function getItemQty($pid) {
        $ret = -1;

        if (key_exists($pid, $this->list)) {
            $ret = $this->list[$pid];
        }

        return $ret;
    }
}



