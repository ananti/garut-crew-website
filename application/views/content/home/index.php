<?if ($lang == Controller::LANG_EN) : ?>
<div id="home_main" class="main">
    <table cellpadding="5px">
        <tr>
            <td colspan="3"><p>Brief description</p></td>
        </tr>
        <tr>
            <td valign="top"><h3>New Product</h3></td>
            <td valign="top"><h3>Most Wanted Product</h3></td>
            <td valign="top"><h3>Latest News</h3></td>
        </tr>
        <tr>
            <td valign="top" width="170px">
                <?if ($new_product->loaded) : ?>
                <?
                    $file_url = json_decode($new_product->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" /><br />
                <a href="<?=url::site('products/view/' . $new_product->id)?>">
                <p><?=substr(strip_tags($new_product->description_en) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
            <td valign="top" width="170px">
                <?if ($most_wanted_product->loaded) : ?>
                <?
                    $file_url = json_decode($most_wanted_product->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" />
                <a href="<?=url::site('products/view/' . $most_wanted_product->id)?>"><br />
                <p><?=substr(strip_tags($most_wanted_product->description_en) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
            <td rowspan="2" valign="top" width="250px">
                <?if ($latest_news->loaded) : ?>
                <?=html::anchor('news/view/' . $latest_news->id , '<strong>' . $latest_news->title_en . '</strong>')?><br />
                <p><?=substr(strip_tags($latest_news->content_en) , 0 , 300)?></p>
                <?=html::anchor('news/view/' . $latest_news->id , 'Read More')?><br />
                <?endif;?>
            </td>
        </tr>
        <tr>
            <td><h3>New Design</h3></td>
            <td><h3>Most Wanted Design</h3></td>
        </tr>
        <tr>
            <td valign="top">
                <?if ($new_design->loaded) : ?>
                <?
                    $file_url = json_decode($new_design->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" /><br />
                <a href="<?=url::site('designs/view/' . $new_design->id)?>">
                <p><?=substr(strip_tags($new_design->description_en) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
            <td valign="top">
                <?if ($most_wanted_design->loaded) : ?>
                <?
                    $file_url = json_decode($most_wanted_design->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" /><br />
                <a href="<?=url::site('designs/view/' . $most_wanted_design->id)?>">
                <p><?=substr(strip_tags($most_wanted_design->description_en) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
        </tr>
    </table>
</div>
<?else : ?>
<div id="home_main" class="main">
    <table cellpadding="5px">
        <tr>
            <td colspan="3"><p>Deskripsi singkat</p></td>
        </tr>
        <tr>
            <td valign="top"><h3>Produk Terbaru</h3></td>
            <td valign="top"><h3>Produk Paling Dicari</h3></td>
            <td valign="top"><h3>Berita Terkini</h3></td>
        </tr>
        <tr>
            <td valign="top" width="170px">
                <?if ($new_product->loaded) : ?>
                <?
                    $file_url = json_decode($new_product->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" /><br />
                <a href="<?=url::site('products/view/' . $new_product->id)?>">
                <p><?=substr(strip_tags($new_product->description) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
            <td valign="top" width="170px">
                <?if ($most_wanted_product->loaded) : ?>
                <?
                    $file_url = json_decode($most_wanted_product->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" />
                <a href="<?=url::site('products/view/' . $most_wanted_product->id)?>"><br />
                <p><?=substr(strip_tags($most_wanted_product->description) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
            <td rowspan="2" valign="top" width="250px">
                <?if ($latest_news->loaded) : ?>
                <?=html::anchor('news/view/' . $latest_news->id , '<strong>' . $latest_news->title_en . '</strong>')?><br />
                <p><?=substr(strip_tags($latest_news->content) , 0 , 300)?></p>
                <?=html::anchor('news/view/' . $latest_news->id , 'Baca Lebih Lengkap')?><br />
                <?endif;?>
            </td>
        </tr>
        <tr>
            <td><h3>Desain Terbaru</h3></td>
            <td><h3>Desain Paling Dicari</h3></td>
        </tr>
        <tr>
            <td valign="top">
                <?if ($new_design->loaded) : ?>
                <?
                    $file_url = json_decode($new_design->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" /><br />
                <a href="<?=url::site('designs/view/' . $new_design->id)?>">
                <p><?=substr(strip_tags($new_design->description) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
            <td valign="top">
                <?if ($most_wanted_design->loaded) : ?>
                <?
                    $file_url = json_decode($most_wanted_design->picture_file_url , TRUE);
                ?>
                <img src="<?=$file_url[1]?>" width="100px" /><br />
                <a href="<?=url::site('designs/view/' . $most_wanted_design->id)?>">
                <p><?=substr(strip_tags($most_wanted_design->description) , 0 , 50)?></p>
                </a>
                <?endif;?>
            </td>
        </tr>
    </table>
</div>
<?endif;?>