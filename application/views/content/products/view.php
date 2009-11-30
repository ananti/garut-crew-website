<?
    $ar_rating = array('1' => 1 , '2' => 2 , '3' => 3 , '4' => 4 , '5' => 5);
    $fileurl = json_decode($product->picture_file_url , TRUE);
?>
<div id="product_detail" class="main">
    <h1 class="title"><?=$product->name?> Details</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor('products' , 'List')?></li>
            <li><?=html::anchor('gallery/view/' . $product->id , 'Gallery')?></li>
        </ul>
    </div>
    <br />
    <table>
        <tr>
            <td><h3>Name</h3></td>
            <td colspan="2"><?=$product->name?></td>
        </tr>
        <tr>
            <td><h3>Description</h3></td>
            <td colspan="2"><?=$product->description?><?=$product->description_en?></td>
        </tr>
        <tr>
            <td><h3>Picture</h3></td>
            <td colspan="2"><img src="<?=$fileurl[1]?>" width="300px" alt="" /></td>
        </tr>
    </table>
    <table cellpadding="5px">
        <thead>
            <tr>
                <th><h3>Comments</h3></th>
                <th><h3>Rating</h3></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?if (count($comments) < 1) :?>
                    There is no comment yet, be the first!<br /><br />
                    <?else:?>
                    <?foreach($comments as $comment) :?>
                    By
                    <?
                        if (!is_null($comment->user_id))
                            echo html::anchor('user/view/' . $comment->user_id , ORM::factory('user' , $comment->user_id)->first_name) . "<br />";
                        else {
                            echo html::mailto($comment->commentator_email , $comment->commentator) . "<br />";
                        }
                    ?>
                    on <?=$comment->submit_date?><br />
                    <p><?=$comment->content?></p><br />
                    <?endforeach;?>
                    <?endif;?>
                    <?=$pagin->render()?>
                    <?=form::open(url::current() , array('name' => 'comment_form' , 'id' => 'comment_form'))?>
                    <?
                    if (!$this->is_login) {
                        echo form::label('name' , 'Name') . "<br />" . form::input('name') . "<br /><br />";
                        echo form::label('email' , 'Email') . "<br />" . form::input('email') . "<br /><br />";
                    }
                    ?>
                    <?=form::textarea('content')?><br />
                    <?=form::submit('submit' , 'Comment')?>
                    <?=form::close()?>
                </td>
                <td valign="top">
                    <?if ($product->rate_count != 0) : ?>
                    <strong><?=$product->rating?></strong><br /><br />
                    <?else :?>
                    No rate yet, be the first!<br /><br />
                    <?endif;?>
                    <?=form::open(url::current() , array('name' => 'rating_form' , 'id' => 'rating_form'))?>
                    <?=form::dropdown('rate' , $ar_rating)?>
                    <?=form::submit('submit' , 'Rate')?>
                    <?=form::close()?>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td>
                <h3><?=($prev_product->id != 0) ? html::anchor('products/view/' . $prev_product->id , "Previous : " . $prev_product->name) : ""?></h3>
            </td>
            <td align="right">
                <h3><?=($next_product->id != 0) ? html::anchor('products/view/' . $next_product->id , "Next : " . $next_product->name) : ""?></h3>
            </td>
        </tr>
    </table>
</div>