<div id="account_settings" class="main">
    <?=form::open(NULL , array('name' => 'account_settings_form' , 'id' => 'account_settings_form'))?>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td class="name"><?=form::label('username','Username')?></td>
            <td><?=form::input('username', $user->username)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('first_name', 'First Name')?></td>
            <td class="value"><?=form::input('first_name', $user->first_name)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('last_name', 'Last Name')?></td>
            <td class="value"><?=form::input('last_name', $user->last_name)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('birthday', 'Birthday')?></td>
            <td class="value"><?=form::input('birthday', $user->birthday)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('email','Email')?></td>
            <td><?=form::input('email', $user->email)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('address','Address')?></td>
            <td><?=form::textarea('address', $user->address)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('zip','Zipcode')?></td>
            <td><?=form::input('zipcode', $user->zipcode)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('phone','Phone')?></td>
            <td><?=form::input('phone', $user->phone)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('password','Password')?></td>
            <td><?=form::password('password', '')?><br />(Leave blank if you don't want to change password)</td>
        </tr>
        <tr>
            <td class="name"><?=form::label('confpassword','Confirm Password')?></td>
            <td><?=form::password('confpassword','')?></td>
        </tr>
    </table>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td colspan="2" style="text-align:center">
                <?=form::submit('submit', 'Save')?>
                <a href="javascript:history.go(-1)">Cancel</a>
            </td>
        </tr>
    </table>
    <?=form::close()?>
</div>