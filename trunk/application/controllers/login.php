<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Menangani login
 * @author petra.barus
 */
class Login_Controller extends Template_Controller {
    public $template = 'two_column';
    protected $restrict_guest = FALSE;

    /**
     * Menampilkan index
     */
    public function index()
    {
        if ($_POST)
        {
            if (Auth::instance()->login($_POST['username'], $_POST['password']))
            {
                if (!isset($_GET['url']))
                {
                    $this->redirect('home', 'Login Success', 'Login Success');
                }
                else
                {
                    $this->redirect($_GET['url'], 'Login Success', 'Login Success');
                }
            }
            else
            {
                $notice = "Username and password mismatch";
            }
        }
        if (isset($notice)) $this->content->notice = $notice;
        $this->title = "Sign In";
    }

    /**
     * Melakukan logout
     */
    public function logout()
    {
        Auth::instance()->logout();
        $this->redirect('login', 'Logout Success', 'Logout Success');
    }
}
//end of file