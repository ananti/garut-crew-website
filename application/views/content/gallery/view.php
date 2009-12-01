<?
    $fileurl = json_decode($product->picture_file_url , TRUE);
?>

<div id="product_gallery" class="main">
    <h1 class="title">Picture Gallery</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor('products/view/' . $product->id , 'List')?></li>
        </ul>
    </div>
    <br />
    <?if (count($fileurl) > 0) :?>
        <div id="gallery_show" style="height:450px;" align="center">
        <?
            foreach ($fileurl as $key => $file) {
                if ($key >= $picture_offset && $key <= $picture_offset + $picture_count - 1)
                    echo '<img src="' . $file . '" height="400px" class="picture" id="pic_'. $key .'" alt="" />&nbsp;';
            }
        ?>
        </div>
        <div id="thumbnail" align="center">
        <table>
            <tr>
        <?
            foreach ($fileurl as $key => $file) {
                if ($key >= $picture_offset && $key <= $picture_offset + $picture_count - 1)
                    echo '<td align="center"><img src="' . $file . '" width="100px" class="thumbnail" id="'. $key .'" style="cursor: pointer;" alt="" /></td>';
            }
        ?>
            </tr>
        </table>
        </div>
        <?=$pagin->render()?>
    <?endif;?>
</div>