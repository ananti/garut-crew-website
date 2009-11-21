<div id="registration_form" class="main">
    <?=form::open(NULL, array('name' => 'registration', 'id' => 'registration'))?>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td class="name"><?=form::label('username','Username')?></td>
            <td><?=form::input('username','')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('email','Email')?></td>
            <td><?=form::input('email','')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('confemail','Confirm Email')?></td>
            <td><?=form::input('confemail', '')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('password','Password')?></td>
            <td><?=form::password('password', '')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('confpassword','Confirm Password')?></td>
            <td><?=form::password('confpassword','')?></td>
        </tr>
    </table>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td class="name"><?=form::label('first_name', 'First Name')?></td>
            <td class="value"><?=form::input('first_name', '')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('last_name', 'Last Name')?></td>
            <td class="value"><?=form::input('last_name', '')?></td>
        </tr>
    </table>
    <table class="columnar2" cellspacing="1px">
        <?if (true):?>
        <tr>
            <td class="name">Verification</td>
            <td class="value">
                <div><img src="<?=url::site('captcha')?>" alt="Captcha" id="captchaimg"/></div>
                <div>Please enter the text from the image above:<br/>
                    The letters <b>are</b> case-sensitive.<br/>
                    Do not type spaces between the numbers and letters.<br/>
                </div>
                <br/>
                <?=form::input('captcha')?>
            </td>
        </tr>
        <?endif;?>
        <tr>
            <td colspan="2" style="text-align:center">
                <?=form::submit('submit', 'Register')?>
            </td>
        </tr>
    </table>
    <?=form::close()?>
</div>