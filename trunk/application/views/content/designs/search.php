<?if ($lang == Controller::LANG_EN) : ?>
<div id="design_list" class="main">
    <h1 class="title">Design Search Result</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor('designs' , 'List')?></li>
        </ul>
    </div>
    <div class="search">
        <?=form::open('designs/search' , array('method' => 'get'))?>
        <?
            $ar_category = Array(
                'name' => 'Name',
                'category' => 'Category'
            );
        ?>
        Search by <?=form::dropdown('search_by' , $ar_category)?>
        <?=form::input('keyword', '')?>
        <?=form::submit('submit', 'Search')?>
        <?=form::close()?>
    </div>
    <table>
        <tr>
            <td><table class="list main">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Rating</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?if (count($designs) < 1) :?>
                    <tr class="empty">
                        <td colspan="5">No Products</td>
                    </tr>
                <?else :?>
                    <?foreach ($designs as $design) :?>
                    <tr class="<?=text::alternate('odd' , 'even')?>">
                        <td><?=html::anchor('designs/view/' . $design->id , $design->name)?></td>
                        <td><?=ORM::factory('category' , $design->category_id)->name?></td>
                        <td><?=$design->rating?></td>
                        <td>Rp <?=$design->price?></td>
                    </tr>
                    <?endforeach;?>
                <?endif;?>
                </tbody>
            </table></td>
        </tr>
    </table>
</div>
<?else :?>
<div id="design_list" class="main">
    <h1 class="title">Hasil Pencarian Desain</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Kembali</a></li>
            <li><?=html::anchor('designs' , 'Daftar Desain')?></li>
        </ul>
    </div>
    <div class="search">
        <?=form::open('designs/search' , array('method' => 'get'))?>
        <?
            $ar_category = Array(
                'name' => 'Nama',
                'category' => 'Kategori'
            );
        ?>
        Cari berdasarkan <?=form::dropdown('search_by' , $ar_category)?>
        <?=form::input('keyword', '')?>
        <?=form::submit('submit', 'Search')?>
        <?=form::close()?>
    </div>
    <table>
        <tr>
            <td><table class="list main">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Rating</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                <?if (count($designs) < 1) :?>
                    <tr class="empty">
                        <td colspan="5">Tidak ditemukan</td>
                    </tr>
                <?else :?>
                    <?foreach ($designs as $design) :?>
                    <tr class="<?=text::alternate('odd' , 'even')?>">
                        <td><?=html::anchor('designs/view/' . $design->id , $design->name)?></td>
                        <td><?=ORM::factory('category' , $design->category_id)->name?></td>
                        <td><?=$design->rating?></td>
                        <td>Rp <?=$design->price?></td>
                    </tr>
                    <?endforeach;?>
                <?endif;?>
                </tbody>
            </table></td>
        </tr>
    </table>
</div>
<?endif;?>