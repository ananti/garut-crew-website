<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Menangani members administration
 * @author petra.barus
 */
class Users_Controller extends Template_Controller {
    public $template = 'two_column';
    protected $restrict_outside_role = array('admin');

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
        $member = ORM::factory('user', $userid);
        if (!$member->loaded)
        {
            $this->redirect('administrator/users', "Not Found", "Specified user not found");
        }
        else
        {
            if ($_POST) {
                
            }
            else {
                $this->content->member = $member;
                $this->head->member= $member;
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