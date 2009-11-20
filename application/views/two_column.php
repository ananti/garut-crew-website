    <?#sebenernya rada jelek sih?>
    <?include('header.php')?>
        <div id="main_two_column">
            <div id="main_left_column">
                <?=View::factory('sidebars/main')->set('auth_user', $this->auth_user)->render()?>
                <?=(isset($this->auth_user) && $this->is_login)?View::factory('sidebars/user_menu')->set('auth_user' , $this->auth_user)->render():'';?>
            </div>
            <?if (!$this->is_login) :?>
                <div id="login_block">
                    <?=form::open('login', array('id'=>'form_login'))?>
                    <?=form::label('username', 'Username')?>
                    <?=form::input('username')?>
                    <?=form::label('password', 'Password')?>
                    <?=form::password('password')?>
                    <?=form::submit('submit', 'Login')?>
                    <?=html::anchor('registration', 'Register')?>
                    <?=form::close();?>
                </div>
            <?endif;?>
            <div id="main_right_column">
                <?=(isset($content))?$content:''?>
            </div>
        </div>
    <?include('footer.php')?>
