<div id="news_list_admin" class="main">
    <h1 class="title">News List</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor(url::site('administrator/news/create'), 'Create')?></li>
            <li><?=html::anchor(url::site('administrator/news'), 'List')?></li>
        </ul>
    </div>
    <table class="list main">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?if (!isset($articles) || is_null($articles) || count($articles) < 0) :?>
            <tr class="empty">
                <td colspan="2">There is no article right now</td>
            </tr>
        <?else :?>
            <?foreach ($articles as $article) :?>
            <tr class="<?=text::alternate('odd' , 'even')?>">
                <td><?=html::anchor('news/view/' . $article->id , $article->title)?></td>
                <td><?if ($article->user_id != 0) echo html::anchor('user/view/' . $article->user_id , ORM::factory('user' , $article->user_id)->first_name)?></td>
                <td><?=$article->created_date?></td>
                <td><?=html::anchor('administrator/news/edit/' . $article->id , "Edit")?>  <span class="delete"><?=html::anchor('administrator/news/delete/' . $article->id , "Delete")?></span></td>
            </tr>
            <?endforeach;?>
        <?endif;?>
        </tbody>
    </table>
    <?=$pagin->render();?>
</div>