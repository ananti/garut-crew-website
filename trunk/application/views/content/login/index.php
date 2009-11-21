<div class="main">
<?=form::open('login', array('id'=>'form_login'))?>
<?=form::open_fieldset()?>
<?=form::legend('Log in')?>
        <?if (isset($notice)){?><div class="notice"><?=$notice?></div><?}?>
        <table>
            <tr>
                <td><?=form::label('username', 'Username')?></td>
                <td><?=form::input('username')?></td>
            </tr><tr>
                <td><?=form::label('password', 'Password')?></td>
                <td><?=form::password('password')?></td>
            </tr><tr>
                <!--
                <td colspan="2"><?=form::hidden('remember_me', 'no')?>
                    <?=form::checkbox('remember_me', 'yes')?>
                    <?=form::label('remember_me', 'Remember Me')?>
                </td>
                -->
            </tr><tr>
                <td colspan="2">
                    <?=form::submit('submit', 'Login')?>
                    <?=html::anchor('register', 'Register')?>
                </td>
            </tr>
        </table>
<?=form::close_fieldset()?>
<?=form::close()?>
</div>
