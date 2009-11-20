    <?#sebenernya rada jelek sih?>
    <?include('header.php')?>
        <div id="main_two_column">
            <div id="main_left_column">
                <?=View::factory('sidebars/main')->set('auth_user', $this->auth_user)->render()?>
                <?
                    echo (isset($this->auth_user) && $this->is_login && $this->auth_user->has_role('member'))?View::factory('sidebars/member_menu')->set('auth_user' , $this->auth_user)->render():'';
                ?>
                <?=(isset($this->auth_user) && $this->is_login && $this->auth_user->has_role('administrator'))? View::factory('sidebars/administrator_menu')->set('auth_user' , $this->auth_user)->render():'';?>
            </div>
            <div id="main_right_column">
                <?=(isset($content))?$content:''?>
            </div>
        </div>
    <?include('footer.php')?>
