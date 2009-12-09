<?if ($lang == Controller::LANG_EN) : ?>
<div id="membership_edit" class="main">
    <h1 class="title">Member / Edit</h1>
    <?=form::open(NULL, array('name' => 'memberedit', 'id' => 'memberedit'))?>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td class="name"><?=form::label('username','Username')?></td>
            <td><?=form::input('username', $user->username)?></td>
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
            <td><?=form::password('password', '')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('confpassword','Confirm Password')?></td>
            <td><?=form::password('confpassword','')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('active', 'Active')?></td>
            <td>
                <?=form::checkbox('active', 'active', $user->has_role('login'));?>
            </td>
        </tr>
        <tr>
            <td class="name"><?=form::label('role', 'Role')?></td>
            <td>
                <?=form::radio('role', 'administrator', ($user->has_role('administrator')))?><b><?=form::label('administrator', 'Administrator')?></b><br/>
                <?=form::radio('role', 'member', (!$user->has_role('administrator') && $user->has_role('member')))?><b><?=form::label('members', 'Member')?></b><br/>
            </td>
        </tr>
    </table>
    <table class="columnar2" cellspacing="1px">
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
<?else :?>
<div id="membership_edit" class="main">
    <h1 class="title">Ubah Rincian Pengguna</h1>
    <?=form::open(NULL, array('name' => 'memberedit', 'id' => 'memberedit'))?>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td class="name"><?=form::label('username','Username')?></td>
            <td><?=form::input('username', $user->username)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('email','Email')?></td>
            <td><?=form::input('email', $user->email)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('address','Alamat')?></td>
            <td><?=form::textarea('address', $user->address)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('zip','Kode pos')?></td>
            <td><?=form::input('zipcode', $user->zipcode)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('phone','Nomor Telepon')?></td>
            <td><?=form::input('phone', $user->phone)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('password','Sandi Lewat')?></td>
            <td><?=form::password('password', '')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('confpassword','Konfirmasi Sandi Lewat')?></td>
            <td><?=form::password('confpassword','')?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('active', 'Aktif')?></td>
            <td>
                <?=form::checkbox('active', 'active', $user->has_role('login'));?>
            </td>
        </tr>
        <tr>
            <td class="name"><?=form::label('role', 'Role')?></td>
            <td>
                <?=form::radio('role', 'administrator', ($user->has_role('administrator')))?><b><?=form::label('administrator', 'Administrator')?></b><br/>
                <?=form::radio('role', 'member', (!$user->has_role('administrator') && $user->has_role('member')))?><b><?=form::label('members', 'Member')?></b><br/>
            </td>
        </tr>
    </table>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td class="name"><?=form::label('first_name', 'Nama Depan')?></td>
            <td class="value"><?=form::input('first_name', $user->first_name)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('last_name', 'Nama Belakang')?></td>
            <td class="value"><?=form::input('last_name', $user->last_name)?></td>
        </tr>
        <tr>
            <td class="name"><?=form::label('birthday', 'Tanggal Lahir')?></td>
            <td class="value"><?=form::input('birthday', $user->birthday)?></td>
        </tr>
    </table>
    <table class="columnar2" cellspacing="1px">
        <tr>
            <td colspan="2" style="text-align:center">
                <?=form::submit('submit', 'Save')?>
                <a href="javascript:history.go(-1)">Batal</a>
            </td>
        </tr>
    </table>
    <?=form::close()?>
</div>
<?endif;?>