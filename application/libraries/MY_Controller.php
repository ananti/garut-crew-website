<?php

/**
 *
 */
class Controller extends Controller_Core
{
    protected $auth_user;
    protected $is_login;
    protected $restrict_guest = TRUE;
    protected $restrict_roles = NULL;
    protected $restrict_outside_roles = NULL;
    protected $items_per_page = 20;	//default item per page-->pagination
    protected $news_per_page = 10;
    //TODO: Restrict outside role

    /**
     * Konstruktor
     */
    public function __construct()
    {
        parent::__construct();
        if (PHP_SAPI == "cli") return;
        $session_key = Kohana::config('auth.session_key');
        $this->auth_user = Session::instance()->get($session_key);
        $this->is_login = (isset($this->auth_user) && ($this->auth_user));

        if ($this->restrict_guest && !$this->is_login)
        {
            $this->redirect_guest();
        }

        if (!is_null($this->restrict_outside_roles))
        {
            if (is_array($this->restrict_outside_roles))
            {
                $roles = $this->restrict_outside_roles;
            }
            else
            {
                $roles = array($this->restrict_outside_roles);
            }
            $check = false;
            foreach($roles as $role)
            {
                $check = $check || $this->auth_user->has_role($role);
            }
            if (!$check)
            {
                $this->redirect('home', 'Authorization mismatch', 'You don\'t have permission to access this page');
            }
        }
        else if (!is_null($this->restrict_roles))
        {
            if (is_array($this->restrict_roles))
            {
                $roles = $this->restrict_roles;
            }
            else
            {
                $roles = array($this->restrict_roles);
            }
            $check = true;
            foreach($roles as $role)
            {
                $check = $check && !$this->auth_user->has_role($role);
            }
            if (!$check)
            {
                $this->redirect('home', 'Authorization mismatch', 'You don\'t have permission to access this page');
            }
        }
    }

    /**
     * Menampilkan redirect untuk guest
     * @param String $url
     * @param String $title
     * @param String $message
     */
    protected function redirect_guest($url = 'login', $title = 'Sign In First', $message = 'You have to be signed in first')
    {
        $this->redirect($url, $title, $message);
    }

    /**
     * Menampilkan redirect jika role user di luar role yang ditentukan
     * @param Array Role $ar_role
     * @param String $url
     * @param String $title
     * @param String $message
     */
    protected function redirect_outside_role($ar_role, $url = 'home', $title = 'Permission Error', $message = 'You can not access this page')
    {
        if ($this->is_login)
        {
            $t = true;
            foreach($ar_role as $role)
            {
                $t &= $this->auth_user->has(ORM::factory('role', $role));
            }
            if (!$t)
            {
                $this->redirect($url, $title, $message);
            }
        }
        else
        {
            $this->redirect($url, $title, $message);
        }
    }

    /**
     * Redirect
     * @param String $url
     * @param String $title
     * @param String $message
     * @param String $layout
     * @param String $time
     */
    protected function redirect($url = NULL, $title = '', $message = '', $layout = 'layout1', $time = 1)
    {
        if ($url == NULL) $url = request::referrer();
        Session::instance()->set_flash('redirect_url', $url);
        Session::instance()->set_flash('redirect_title', $title);
        Session::instance()->set_flash('redirect_message', $message);
        Session::instance()->set_flash('redirect_layout', $layout);
        Session::instance()->set_flash('redirect_time', $time);
        url::redirect('redirect');
        exit;
    }

     /**
      * Set Session for Redirection
      * @param String $url
      * @param String $title
      * @param String $message
      * @param String $layout
      * @param String $time
      */
    public static function setredirect($url = NULL, $title = '', $message = '', $layout = 'layout1', $time = 1)
    {
        if ($url == NULL) $url = request::referrer();
        Session::instance()->set_flash('redirect_url', $url);
        Session::instance()->set_flash('redirect_title', $title);
        Session::instance()->set_flash('redirect_message', $message);
        Session::instance()->set_flash('redirect_layout', $layout);
        Session::instance()->set_flash('redirect_time', $time);
    }
}
