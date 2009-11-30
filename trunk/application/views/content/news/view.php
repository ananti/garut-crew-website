<div id="news_detail" class="main">
    <h1 class="title"><?=$article->title?></h1>
    <h1 class="title"><?=$article->title_en?></h1>
    <div class="links" style="clear:both">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?if ($auth_user && $auth_user->has_role('administrator')) echo html::anchor(url::site('administrator/news/edit/' . $article->id) , "Edit");?></li>
        </ul>
    </div>
    <br />
    <div class="content">
        <?=$article->content?>
        <?=$article->content_en?>
    </div>
    <table>
        <tr>
            <td>
                <?=($prev_article->id != 0) ? html::anchor('news/view/' . $prev_article->id , "Previous : " . $prev_article->title) : ""?>
            </td>
            <td align="right">
                <?=($next_article->id != 0) ? html::anchor('news/view/' . $next_article->id , "Next : " . $next_article->title) : ""?>
            </td>
        </tr>
    </table>
</div>
