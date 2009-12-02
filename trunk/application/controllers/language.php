<?php defined('SYSPATH') OR die('No direct access allowed.');

class Language_Controller extends Controller {
    protected $restrict_guest = false;
    
    public function SetLanguageEN() {
        cookie::delete($this->lang_cookie_key);
        cookie::set($this->lang_cookie_key , 'EN');
        url::redirect(url::base() . request::referrer());
    }

    public function SetLanguageID() {
        cookie::delete($this->lang_cookie_key);
        cookie::set($this->lang_cookie_key , 'ID');
        url::redirect(url::base() . request::referrer());
    }
}