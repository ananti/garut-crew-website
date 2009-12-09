<?
$table_header = '<table class="list main">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="empty" style="display:none">
                        <td colspan="6">There is no user</td>
                    </tr>';
?>

<?if ($lang == Controller::LANG_EN) : ?>
<div id="membership_edit" class="main">
    <h1 class="title">Member / Edit</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor(url::site('administrator/users'), 'List')?></li>
            <li><?=html::anchor(url::site('administrator/users/create'), 'Create')?></li>
        </ul>
    </div>
    <div class="description">
        Below is list of members
    </div>
    <div id="role_tabs" class="tabs">
        <ul>
            <li><a href="#all_tab">All</a></li>
            <li><a href="#administrator_tab">Administrators</a></li>
            <li><a href="#member_tab">Members</a></li>
        </ul>
        <div id="all_tab" class="container">
            <?=$table_header?>
            <?foreach($users as $user):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$user->id?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->username)?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->first_name . ' ' . $user->last_name)?></td>
                <td><?=html::mailto($user->email)?></td>
                <td><?
                   $db = new Database();
                   $role = $db->query('SELECT role_id FROM roles_users WHERE user_id = ? AND role_id <> 2' , $user->id);
                   foreach ($role as $r)
                        $role_id = $r->role_id;

                   $role = ORM::factory('role')->where('id' , $role_id)->select('name')->find_all();
                   foreach ($role as $r)
                        echo $r->name;
                ?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Edit')?>
                    <?=($this->auth_user->id != $user->id) ? html::anchor('administrator/users/delete/'.$user->id, 'Delete') : ""?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div id="administrator_tab" class="container">
            <?=$table_header?>
            <?foreach($administrators as $user):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$user->id?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->username)?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->first_name . ' ' . $user->last_name)?></td>
                <td><?=html::mailto($user->email)?></td>
                <td><?
                   $db = new Database();
                   $role = $db->query('SELECT role_id FROM roles_users WHERE user_id = ? AND role_id <> 2' , $user->id);
                   foreach ($role as $r)
                        $role_id = $r->role_id;

                   $role = ORM::factory('role')->where('id' , $role_id)->select('name')->find_all();
                   foreach ($role as $r)
                        echo $r->name;
                ?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Edit')?>
                    <?=($this->auth_user->id != $user->id) ? html::anchor('administrator/users/delete/'.$user->id, 'Delete') : ""?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div id="member_tab" class="container">
            <?=$table_header?>
            <?foreach($members as $user):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$user->id?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->username)?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->first_name . ' ' . $user->last_name)?></td>
                <td><?=html::mailto($user->email)?></td>
                <td><?
                   $db = new Database();
                   $role = $db->query('SELECT role_id FROM roles_users WHERE user_id = ? AND role_id <> 2' , $user->id);
                   foreach ($role as $r)
                        $role_id = $r->role_id;

                   $role = ORM::factory('role')->where('id' , $role_id)->select('name')->find_all();
                   foreach ($role as $r)
                        echo $r->name;
                ?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Edit')?>
                    <?=($this->auth_user->id != $user->id) ? html::anchor('administrator/users/delete/'.$user->id, 'Delete') : ""?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?else : ?>
<div id="membership_edit" class="main">
    <h1 class="title">Ubah Detail Pengguna</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor(url::site('administrator/users/create'), 'Buat Pengguna')?></li>
            <li><?=html::anchor(url::site('administrator/users'), 'Daftar Pengguna')?></li>
        </ul>
    </div>
    <div class="description">
        Daftar pengguna
    </div>
    <div id="role_tabs" class="tabs">
        <ul>
            <li><a href="#all_tab">Semua</a></li>
            <li><a href="#administrator_tab">Administrators</a></li>
            <li><a href="#member_tab">Members</a></li>
        </ul>
        <div id="all_tab" class="container">
            <?=$table_header?>
            <?foreach($users as $user):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$user->id?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->username)?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->first_name . ' ' . $user->last_name)?></td>
                <td><?=html::mailto($user->email)?></td>
                <td><?
                   $db = new Database();
                   $role = $db->query('SELECT role_id FROM roles_users WHERE user_id = ? AND role_id <> 2' , $user->id);
                   foreach ($role as $r)
                        $role_id = $r->role_id;

                   $role = ORM::factory('role')->where('id' , $role_id)->select('name')->find_all();
                   foreach ($role as $r)
                        echo $r->name;
                ?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Ubah')?>
                    <?=($this->auth_user->id != $user->id) ? html::anchor('administrator/users/delete/'.$user->id, 'Hapus') : ""?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div id="administrator_tab" class="container">
            <?=$table_header?>
            <?foreach($administrators as $user):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$user->id?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->username)?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->first_name . ' ' . $user->last_name)?></td>
                <td><?=html::mailto($user->email)?></td>
                <td><?
                   $db = new Database();
                   $role = $db->query('SELECT role_id FROM roles_users WHERE user_id = ? AND role_id <> 2' , $user->id);
                   foreach ($role as $r)
                        $role_id = $r->role_id;

                   $role = ORM::factory('role')->where('id' , $role_id)->select('name')->find_all();
                   foreach ($role as $r)
                        echo $r->name;
                ?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Ubah')?>
                    <?=($this->auth_user->id != $user->id) ? html::anchor('administrator/users/delete/'.$user->id, 'Hapus') : ""?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div id="member_tab" class="container">
            <?=$table_header?>
            <?foreach($members as $user):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$user->id?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->username)?></td>
                <td><?=html::anchor('user/view/'.$user->id, $user->first_name . ' ' . $user->last_name)?></td>
                <td><?=html::mailto($user->email)?></td>
                <td><?
                   $db = new Database();
                   $role = $db->query('SELECT role_id FROM roles_users WHERE user_id = ? AND role_id <> 2' , $user->id);
                   foreach ($role as $r)
                        $role_id = $r->role_id;

                   $role = ORM::factory('role')->where('id' , $role_id)->select('name')->find_all();
                   foreach ($role as $r)
                        echo $r->name;
                ?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Ubah')?>
                    <?=($this->auth_user->id != $user->id) ? html::anchor('administrator/users/delete/'.$user->id, 'Hapus') : ""?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?endif;?>