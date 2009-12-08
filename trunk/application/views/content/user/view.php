<div id="user_detail" class="main">
    <h1 class="title"><?=$user->first_name . " " . $user->last_name?></h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
        </ul>
    </div>
    <table class="main columnar2">
        <tr>
            <td class="name">User Name</td>
            <td class="value"><?=$user->username?></td>
        </tr>
        <tr>
            <td class="name">Login count</td>
            <td class="value"><?=$user->logins?></td>
        </tr>
        <tr>
            <td class="name">Birthday</td>
            <td class="value"><?=$user->birthday?></td>
        </tr>
        <tr>
            <td class="name">Designs created</td>
            <td class="value"><?
                foreach($designs as $design) {
                    echo html::anchor('designs/view/' . $design->id , $design->name) . "<br />";
                }
            ?></td>
        </tr>
        <?if ($auth_user && $auth_user->has_role('administrator')) : ?>
        <tr>
            <td class="name">Email</td>
            <td class="value"><?=html::mailto($user->email)?></td>
        </tr>
        <tr>
            <td class="name">Address</td>
            <td class="value"><?=$user->address?></td>
        </tr>
        <tr>
            <td class="name">Zip code</td>
            <td class="value"><?=$user->zipcode?></td>
        </tr>
        <tr>
            <td class="name">Phone number</td>
            <td class="value"><?=$user->phone?></td>
        </tr>
        <?endif;?>
    </table>
</div>