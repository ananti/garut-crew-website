<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * JSON handler untuk user
 * @author petra.barus.barus
 */
class User_Controller extends JSON_Controller {
    protected $restrict_guest = TRUE;

    /**
     *
     */
    public function  __construct() {
        if (in_array(Router_Core::$method, array('login', 'register'))) $this->restrict_guest = FALSE;
        parent::__construct();
    }

    /**
     * Mengembalikan true jika username ada
     * @param String $username
     */
    public function exists_username($username = NULL)
    {
        if (is_null($username)) $username = $_REQUEST['value'];
        $isexists = User_Model::exists_username($username);
        $this->return = $isexists;
    }

    /**
     * Mengembalikan true jika email ada
     * @param String $email
     */
    public function exists_email($email)
    {
        $this->return = array('result'=>true);
    }

    /**
     * Register user
     */
    public function register()
    {
        if ($_POST){
            //TODO: Validate Captcha
            $username = $_POST['username'];
            if (User_Model::exists_username($username))
            {
                $this->return = array('result' => false, 'reason' => 'exists_username');
                return;
            }
            $email = $_POST['email'];
            if (User_Model::exists_email($email))
            {
                $this->return = array('result' => false, 'reason' => 'exists_email');
                return;
            }
            if (!Captcha::valid($_POST['captcha']))
            {
                $this->return = array('result' => false, 'reason' => 'invalid_captcha');
                return;
            }
            $password = $_POST['password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            //Saving the data
            $user = ORM::factory('user');
            $user->username = $username;
            $user->password = $password;
            $user->email = $email;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->add(ORM::factory('role', 'login'));
            $user->add(ORM::factory('role', 'member'));

            $user->save();
            Auth::instance()->login($username, $password);
            $this->return = array('result' => true, 'reason' => 'ok');
            $this->setredirect('home', 'Register success', 'Registration success');
        }
    }

    /**
     * Get list all user
     */
    public function get_user_list()
    {
        $arrayuser = array();
        $alluser = ORM::factory('user')->find_all();
        foreach($alluser as $user)
        {
            $arrayuser[] = $user->as_array();
        }
        $this->return = $arrayuser;
    }

    /**
     * Login
     */
    public function login()
    {
        if ($this->is_login)
        {
            $this->return = array('result' => false, 'reason' => 'already_logged_in');
        }
        else if(!isset($_POST['username']) || !isset($_POST['password']))
        {
            $this->return = array('result' => false, 'reason' => 'username_password_blank');
        }
        else if (!Auth::instance()->login($_POST['username'], $_POST['password']))
        {
            $this->return = array('result' => false, 'reason' => 'username_password_mismatch');
        }
        else
        {
            $this->return = array('result' => true, 'reason' => 'ok');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        if (!$this->is_login)
        {
            $this->return = false;
        }
        else
        {
            Auth::instance()->logout();
            $this->return = true;
        }
    }

    /**
     * Get current user data
     */
    public function get_current_user()
    {
        if (!$this->is_login)
        {
            $this->return = false;
        }
        else
        {
            $this->return = $this->auth_user->as_array();
        }
    }

    /**
     *
     * @param <type> $id
     */

    public function accountedit($id)
    {
        $user = ORM::factory('user' , $id);
        if (!$user->loaded)
        {
            $this->return = array('result' => false, 'reason' => 'member_not_found');
        }
        else
        {
            if ($_POST['username'] != $user->username && User_Model::exists_username($_POST['username']))
            {
                $this->return = array('result' => false, 'reason' => 'exists_username');
            }
            else if ($_POST['email'] != $user->email && User_Model::exists_email($_POST['email']))
            {
                $this->return = array('result' => false, 'reason' => 'exists_email');
            }
            else
            {
                $user->username = $_POST['username'];
                $user->first_name = $_POST['first_name'];
                $user->last_name = $_POST['last_name'];
                $user->email = $_POST['email'];
                $user->address = $_POST['address'];
                $user->zipcode = $_POST['zipcode'];
                $user->phone = $_POST['phone'];
                $user->birthday = $_POST['birthday'];
                if (isset($_POST['password']) && strlen($_POST['password']) > 0)
                {
                    $member->password = $_POST['password'];
                }
                $user->save();
                if ($user->has_role('member')) 
                    $this->setredirect(url::site('member/settings'), "Success", "Success");
                else if ($user->has_role('administrator'))
                    $this->setredirect(url::site('administrator/settings'), "Success", "Success");
                $this->return = array('result' => true, 'reason' => 'OK');
            }
        }
    }

    /**
     *
     * @param int $id
     */
    public function memberedit($id)
    {
        if ($this->auth_user->has_role('admin'))
        {
            $member = ORM::factory('user', $id);
            if (!$member->loaded)
            {
                $this->return = array('result' => false, 'reason' => 'member_not_found');
            }
            else
            {
                if ($_POST['username'] != $member->username && User_Model::exists_username($_POST['username']))
                {
                    $this->return = array('result' => false, 'reason' => 'exists_username');
                }
                else if ($_POST['email'] != $member->email && User_Model::exists_email($_POST['email']))
                {
                    $this->return = array('result' => false, 'reason' => 'exists_email');
                }
                else
                {
                    $member->username = $_POST['username'];
                    $member->email = $_POST['email'];
                    $member->institution = $_POST['institution'];
                    $member->institution_address = $_POST['institution_address'];
                    $member->institution_phone = $_POST['institution_phone'];
                    $member->handphone = $_POST['handphone'];
                    if (isset($_POST['password']) && strlen($_POST['password']) > 0)
                    {
                        $member->password = $_POST['password'];
                    }
                    //Membuang semua role dulu
                    $roles = ORM::factory('role')->find_all();
                    foreach($roles as $role)
                    {
                        $member->remove($role);
                    }
                    if(isset($_POST['active']))
                    {
                        $member->add(ORM::factory('role', 'login'));
                    }
                    if (isset($_POST['role']))
                    {
                        switch ($_POST['role']) {
                            case 'admin':
                                $member->add(ORM::factory('role', 'admin'));
                                $member->add(ORM::factory('role', 'coach'));
                                break;
                            case 'coach':
                                $member->add(ORM::factory('role', 'coach'));
                                break;
                            case 'learner':
                                $member->add(ORM::factory('role', 'learner'));
                                break;
                            default:
                                break;
                        }
                    }
                    $member->full_name = $_POST['fullname'];
                    $member->save();
                    $this->setredirect(url::site('administration/members'), "Success", "Success");
                    $this->return = array('result' => true, 'reason' => 'OK');
                }
            }
        }
        else
        {
            $this->return = array('result' => true, 'reason' => 'not_admin');
        }
    }


    public function membercreate()
    {
        if ($this->auth_user->has_role('admin'))
        {
            $member = ORM::factory('user');
            if (User_Model::exists_username($_POST['username']))
            {
                $this->return = array('result' => false, 'reason' => 'exists_username');
            }
            else if (User_Model::exists_email($_POST['email']))
            {
                $this->return = array('result' => false, 'reason' => 'exists_email');
            }
            else
            {
                $member->username = $_POST['username'];
                $member->email = $_POST['email'];
                $member->institution = $_POST['institution'];
                $member->institution_address = $_POST['institution_address'];
                $member->institution_phone = $_POST['institution_phone'];
                if (isset($_POST['password']) && strlen($_POST['password']) > 0)
                {
                    $member->password = $_POST['password'];
                }
                //Membuang semua role dulu
                $roles = ORM::factory('role')->find_all();
                foreach($roles as $role)
                {
                    $member->remove($role);
                }
                if(isset($_POST['active']))
                {
                    $member->add(ORM::factory('role', 'login'));
                }
                if (isset($_POST['role']))
                {
                    switch ($_POST['role']) {
                        case 'admin':
                            $member->add(ORM::factory('role', 'admin'));
                            $member->add(ORM::factory('role', 'coach'));
                            break;
                        case 'coach':
                            $member->add(ORM::factory('role', 'coach'));
                            break;
                        case 'learner':
                            $member->add(ORM::factory('role', 'learner'));
                            break;
                        default:
                            break;
                    }
                }
                $member->full_name = $_POST['fullname'];
                $member->save();
                $this->setredirect(url::site('administration/members'), "Success", "User added");
                $this->return = array('result' => true, 'reason' => 'OK');
            }
        }
        else
        {
            $this->return = array('result' => true, 'reason' => 'not_admin');
        }
    }
}
//end of file