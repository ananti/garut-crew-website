<?php defined('SYSPATH') OR die('No direct access allowed.');


class Order_Controller extends Template_Controller {
    protected $restrict_guest = false;

    public function index() {
        $this->title = "Order our products";
    }
}