<?
$table_header = '<table class="list main">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="empty" style="display:none">
                        <td colspan="6">There is no user</td>
                    </tr>';
?>


<pre>
<?
    foreach($users as $user) {
        //print_r($user);
    }
?>
</pre>

<div id="membership_edit" class="main">
    <h1 class="title">Member / Edit</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor(url::site('administrator/users'), 'List')?></li>
            <li><?=html::anchor(url::site('administrator/users/create'), 'Create')?></li>
        </ul>
    </div>
    <div class="search">
        <?=form::open('administratr/users/search')?>
        <?=form::input('keyword', '')?>
        <?=form::submit('submit', 'Search')?>
        <?=form::close()?>
    </div>
    <div class="description">
        Below is list of members
    </div>
    <div id="role_tabs" class="tabs">
        <ul>
            <li><a href="#all_tab">All</a></li>
            <li><a href="#administrator_tab">Administrators</a></li>
            <li><a href="#coach_tab">Members</a></li>
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
                <td><?//=$user->join_time?></td>
                <td>
                    <?=html::anchor('administrator/users/edit/'.$user->id, 'Edit')?>
                    <?=html::anchor('#', 'Delete')?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        
    </div>
</div>


<?
/**
 *
 * <div id="administrator_tab" class="container">
            <?=$table_header?>
            <?foreach($administrators as $member):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$member->id?></td>
                <td><?=html::anchor('member/view/'.$member->id, $member->username)?></td>
                <td><?=html::anchor('member/view/'.$member->id, $member->full_name)?></td>
                <td><?=html::mailto($member->email)?></td>
                <td><?=$member->join_time?></td>
                <td>
                    <?=html::anchor('administration/members/edit/'.$member->id, 'Edit')?>
                    <?=html::anchor('#', 'Delete')?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div id="coach_tab" class="container">
            <?=$table_header?>
            <?foreach($coaches as $member):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$member->id?></td>
                <td><?=html::anchor('member/view/'.$member->id, $member->username)?></td>
                <td><?=html::anchor('member/view/'.$member->id, $member->full_name)?></td>
                <td><?=html::mailto($member->email)?></td>
                <td><?=$member->join_time?></td>
                <td>
                    <?=html::anchor('administration/members/edit/'.$member->id, 'Edit')?>
                    <?=html::anchor('#', 'Delete')?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div id="learner_tab" class="container">
            <?=$table_header?>
            <?foreach($learners as $member):?>
            <tr class="<?=text::alternate('odd', 'even')?>">
                <td></td>
                <td><?=$member->id?></td>
                <td><?=html::anchor('member/view/'.$member->id, $member->username)?></td>
                <td><?=html::anchor('member/view/'.$member->id, $member->full_name)?></td>
                <td><?=html::mailto($member->email)?></td>
                <td><?=$member->join_time?></td>
                <td>
                    <?=html::anchor('administration/members/edit/'.$member->id, 'Edit')?>
                    <?=html::anchor('#', 'Delete')?>
                </td>
            </tr>
            <?endforeach;?>
            </tbody>
            </table>
        </div>
        <div>
            <strong>Upload CSV data</strong><br/>
            Below you could upload member data from CSV data
            <?=form::open(url::site('administration/members/uploaddata'), array('enctype' => 'multipart/form-data'))?>
            <table style="margin:auto;">
                <tr>
                    <td class="name" style="font-weight:bold;"><?=form::label('override', 'Override')?></td>
                    <td class="value"><?=form::checkbox(array('name' => 'override'), '')?></td>
                </tr>
                <tr>
                    <td class="name" style="font-weight:bold;"><?=form::label('datafile', 'Data file')?></td>
                    <td class="value"><?=form::upload(array('name' => 'datafile'), '')?></td>
                </tr>
                <tr class="links">
                    <td colspan="2" class="submit"><?=form::submit('submit', 'Submit')?></td>
                </tr>
            </table>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <?=form::close()?>
        </div>
 */

?>