<?php defined('SYSPATH') OR die('No direct access allowed.');

class Settings_Controller extends Template_Controller {
    public $template = 'two_column';
    protected $restrict_outside_roles = array('member');


    public function index()
    {
        $this->head->user = $this->auth_user;
        $this->content->user = $this->auth_user;
        $this->title = "Account settings";
    }

}