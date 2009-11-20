<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Menangani members administration
 * @author petra.barus
 */
class Users_Controller extends Template_Controller {
    public $template = 'two_column';
    protected $restrict_outside_roles = array('administrator');

    /**
     * Default index, menampilkan member
     */
    public function index()
    {
        $this->content->users = ORM::factory('user')->find_all();
        $db = new Database();

        $this->content->administrators = $db->query('SELECT *
                           FROM `roles_users`
                           JOIN `users`
                           ON (users.id = roles_users.user_id AND roles_users.role_id = 1)');
        $this->content->members = $db->query('SELECT *
                           FROM `roles_users`
                           JOIN `users`
                           ON (users.id = roles_users.user_id AND roles_users.role_id = 3)');
        $this->title = 'Member List';
    }


    /**
     * Menyunting data member
     * @param <type> $id
     */
    public function edit($userid)
    {
        //TODO: view
        $user = ORM::factory('user', $userid);
        if (!$user->loaded)
        {
            $this->redirect('administrator/users', "Not Found", "Specified user not found");
        }
        else
        {
            if ($_POST) {
                if ($_POST['username'] != $user->username && User_Model::exists_username($_POST['username']))
                {
                    $this->redirect(url::site('administrator/users/edit/' . $user->id), "Failed", "Username already exists");
                }
                else if ($_POST['email'] != $user->email && User_Model::exists_email($_POST['email']))
                {
                    $this->redirect(url::site('administrator/users/edit/' . $user->id), "Failed", "Email already exists");
                }
                else if (isset($_POST['password']) && strlen($_POST['password']) > 0 && $_POST['password'] != $_POST['confpassword'])
                {
                    $this->redirect(url::site('administrator/users/edit/' . $user->id), "Failed", "Password mismatch");
                }
                else {
                    $user->username = $_POST['username'];
                    $user->first_name = $_POST['first_name'];
                    $user->last_name = $_POST['last_name'];
                    $user->email = $_POST['email'];
                    $user->birthday = $_POST['birthday'];
                    $user->address = $_POST['address'];
                    $user->zipcode = $_POST['zipcode'];
                    $user->phone = $_POST['phone'];
                    
                    $roles = ORM::factory('role')->find_all();
                    foreach($roles as $role)
                    {
                        $user->remove($role);
                    }
                    if(isset($_POST['active']))
                    {
                        $user->add(ORM::factory('role', 'login'));
                    }
                    if (isset($_POST['role']))
                    {
                        switch ($_POST['role']) {
                            case 'administrator':
                                $user->add(ORM::factory('role', 'administrator'));
                                break;
                            case 'member':
                                $user->add(ORM::factory('role', 'member'));
                                break;
                            default:
                                break;
                        }
                    }
                    if (isset($_POST['password']) && strlen($_POST['password']) > 0)
                    {
                        $user->password = $_POST['password'];
                    }
                    $user->save();
                    $this->redirect(url::site('administrator/users/edit/' . $user->id), "Success", "Success");
                }
            }
            else {
                $this->content->user = $user;
                $this->head->user = $user;
                $this->title = 'User Edit';
            }
        }
    }

    /**
     *
     */

    public function create()
    {
        $this->title = "Create New User";
    }

    /**
     * Upload Data
     */
    public function uploaddata()
    {
        if (is_uploaded_file($_FILES['datafile']['tmp_name'])) {
            $path = $_FILES['datafile']['tmp_name'];
            $ar = csv::parse($path);
            if (isset($_POST['override']))
            {
                $retval = User_Model::batch_add($ar , TRUE);
            }
            else
            {
                $retval = User_Model::batch_add($ar);
            }
            $this->redirect(NULL, 'User(s) added', 'User(s) added');
        } else {
            $this->redirect(NULL, "Error", "Error Uploading File");
        }
        exit;
    }
}