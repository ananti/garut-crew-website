<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 */
class User_Model extends Auth_User_Model {
    protected $has_and_belongs_to_many = array('roles');

    /**
     * Batch add user
     * @param $data
     * @param $override Override existing users
     */
    public static function batch_add($users, $override = FALSE)
    {
        $message = '';
        $userssuccess = array();
        $usersfailed = array();
        $overrideuser = 0;
        $addeduser = 0;
        foreach($users as $user)
        {
            $newuser = ORM::factory('user');
            if (self::exists_username($user['username']))
            {
                $overrideuser++;
                if ($override)
                {
                    //TODO: Override
                    $newuser = $newuser->where('username' , $user['username'])->find();
                    if ((self::exists_email($user['email'])) && ($newuser->email != $user['email']))
                    {
                        $usersfailed[] = $user['username'];
                        continue;
                    }
                    else
                    {
                        $newuser->username = $user['username'];
                        $newuser->password = $user['password'];
                        $newuser->email = $user['email'];
                        $newuser->full_name = $user['full name'];
                        $newuser->handphone = $user['handphone'];
                        $newuser->save();
                        $userssuccess[] = $user['username'];
                        continue;
                    }
                    //echo($newuser->id . "<br />");
                }
                else
                {
                    $usersfailed[] = $user['username'];
                    continue;
                }
            }
            if (self::exists_email($user['email']))
            {
                $usersfailed[] = $user['username'];
                continue;
            }
            $newuser->username = $user['username'];
            $newuser->password = $user['password'];
            $newuser->email = $user['email'];
            $newuser->full_name = $user['full name'];
            $newuser->handphone = $user['handphone'];
            $newuser->add(ORM::factory('role', 'login'));
            $newuser->add(ORM::factory('role', 'learner'));
            $newuser->save();
            $userssuccess[] = $user['username'];
            $addeduser++;
        }
        $return = array(
            'userssuccess' => $userssuccess,
            'usersfailed' => $usersfailed
        );
        return $return;
    }

    /**
     * Check unique username
     * @param string $username
     * @return true if username is unique
     */
    public static function exists_username($username)
    {
        $username_exists = (bool) ORM::factory('user')->where('username', $username)->count_all();
        return (bool)$username_exists;
    }

    /**
     * Check unique email
     * @param string $email
     * @return true if email is unique
     */
    public static function exists_email($email)
    {
        $email_exists = (bool) ORM::factory('user')->where('email', $email)->count_all();
        return (bool)$email_exists;
    }

    /**
     * Check whether user has specified role
     * @params $role the role
     * @return true if user has the role
     */
    public function has_role($role)
    {
        return $this->has(ORM::factory('role', $role));
    }

    /**
     * Check whether user is administrator
     * @return true if user is administrator
     */
    public function is_admin()
    {
        return $this->has(ORM::factory('role', 'admin'));
    }

    /**
     * Load inbox message
     * @return inbox messages
     */
    public function get_received_messages()
    {
        $uid = $this->id;
        //NOTE: Kohana still doesn't support ^_^
        return ORM::factory('private_message')->join('private_messages_recipients', 'private_messages_recipients.private_message_id', 'private_messages.id')->where('private_messages_recipients.recipient_id', $this->id)->orderby('send_time', 'ASC')->find_all();
    }

    /**
     * Load sent messages
     * @return sent messages
     */
    public function get_sent_messages()
    {
        return ORM::factory('private_message')->where('sender_id', $this->id)->find_all();
    }
    /**-----------------------------------------------*/

    /**
     * Load contests owned by users
     * @return contests
     */
    public function get_owned_contests()
    {
        if (!$this->has_role('coach'))
        return array();
        return ORM::factory('contest')->where('owner_id', $this->id)->find_all();
    }

    /**
     * Load contest supervised by users
     * @return contests
     */
    public function get_supervised_contests()
    {
        if (!$this->has_role('coach'))
        return array();
        return ORM::factory('contest')->join('contest_supervisors', 'contest_supervisors.contest_id', 'contests.id')->where('contest_supervisors.supervisor_id', $this->id)->find_all();
    }

    /**
     * Load contests participated by users
     * @return contests
     */
    public function get_participated_contests()
    {
        if (!$this->has_role('learner'))
        return array();
        return ORM::factory('contest')->join('contest_contestants', 'contest_contestants.contest_id', 'contests.id')->where('contest_contestants.contestant_id', $this->id)->find_all();
    }

    /**
     * Load contests NOT owned AND NOT supervised by user
     * @return contests
     */
    public function get_other_contests()
    {
        if (!$this->has_role('coach') && !$this->has_role('learner')) {
            return ORM::factory('contest')->find_all();
        } else {
            $all = ORM::factory('contest')->find_all();
            $owned = $this->get_owned_contests();
            $supervised = $this->get_supervised_contests();
            $participated = $this->get_participated_contests();
            $atemp = array();
            foreach ($all as $i => $one) {
                $found = false;
                for ($j=0; !$found && $j<count($owned); $j++) {
                    if ($owned[$j]->id == $one->id) $found = true;
                }
                for ($j=0; !$found && $j<count($supervised); $j++) {
                    if ($supervised[$j]->id == $one->id) $found = true;
                }
                for ($j=0; !$found && $j<count($participated); $j++) {
                    if ($participated[$j]->id == $one->id) $found = true;
                }
                if (!$found) {
                    $atemp[] = $one;
                }
            }
            return $atemp;
        }
    }

    /**
     * Apakah user jadi supervisor sebuah kontes
     * @param int $contest_id
     * @return boolean
     */
    public function is_supervising($contest_id) {
        $atemp = ORM::factory('contest')->join('contest_supervisors', 'contest_supervisors.contest_id', 'contests.id')->where('contest_supervisors.supervisor_id', $this->id)->where('contests.id', $contest_id)->find_all();
        return (count($atemp) > 0);
    }

    /**
     * Apakah user jadi owner sebuah kontes
     * @param int $contest_id
     * @return boolean
     */
    public function is_owning($contest_id) {
        $atemp = ORM::factory('contest', $contest_id);
        return ($atemp->owner_id == $this->id);
    }

    /**
     * Apakah user jadi participant sebuah kontes
     * @param int $contest_id
     * @return boolean
     */
    public function is_participating($contest_id) {
        $atemp = ORM::factory('contest')->join('contest_contestants', 'contest_contestants.contest_id', 'contests.id')->where('contest_contestants.contestant_id', $this->id)->where('contests.id', $contest_id)->find_all();
        return (count($atemp) > 0);
    }

    /**
     * Apakah user ada dalam kontest
     * @param int $contest_id
     * @return boolean
     */
    public function is_authorized_on_contest($contest_id)
    {
        return $this->is_owning($contest_id) || $this->is_participating($contest_id) || $this->is_supervising($contest_id);
    }

    /**
     * mengembalikan array of ID roles yg dimiliki
     * @return array
     */
    public function get_array_roles() {
        $aroles = $this->roles;
        $result = array();
        foreach ($aroles as $arole) {
            $result[] = $arole->id;
        }
        return $result;
    }

    /**
     * Set user as array
     * @param <type> $masked
     * @return <type>
     */
    public function as_array($masked = true)
    {
        $ar = parent::as_array();
        if ($masked)
        {
            $maskedkey = array('password','logins', "activation_code");
            foreach ($maskedkey as $key)
            {
                unset($ar[$key]);
            }
        }
        return $ar;
    }
}
//end of file