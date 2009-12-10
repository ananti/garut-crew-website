    <?#sebenernya rada jelek sih?>
    <?include('header.php')?>
        <div id="main_two_column">
            <div id="main_left_column">
                <?=View::factory('sidebars/main')->set('auth_user', $this->auth_user)->render()?>
                <?
                    echo (isset($this->auth_user) && $this->is_login && $this->auth_user->has_role('member'))? View::factory('sidebars/member_menu')->set('auth_user' , $this->auth_user)->render():'';
                ?>
                <?=(isset($this->auth_user) && $this->is_login && $this->auth_user->has_role('administrator'))? View::factory('sidebars/administrator_menu')->set('auth_user' , $this->auth_user)->render():'';?>
            </div>
            <div id="main_right_column">
                <?if (!$this->is_login && url::current() != 'login') : ?>
                <div id="login_block" style="padding-left:10px;padding-right:10px;padding-top:5px;" align="right">
                    <?=form::open('login', array('id'=>'form_login'))?>
                    Username : <?=form::input('username')?>
                    Password : <?=form::password('password')?>
                    <?=form::submit('submit', 'Login')?>
                    <?=html::anchor('register', 'Register')?>
                    <?=form::close()?>
                </div>
                <?endif;?>
                <div id="lang_chooser" style="padding-right:10px;padding-top:5px;" align="right">
                    <?=form::radio('lang' , 'ID' , cookie::get($this->lang_cookie_key) == 'ID')?>
                    <?=form::label('lang' , 'Bahasa Indonesia')?>
                    <?=form::radio('lang' , 'EN' , cookie::get($this->lang_cookie_key) == 'EN')?>
                    <?=form::label('lang' , 'English')?>
                </div>
                <?=(isset($content))?$content:''?>
            </div>
        </div>
    <?include('footer.php')?>
