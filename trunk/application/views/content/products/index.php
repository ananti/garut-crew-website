<?if ($lang == Controller::LANG_EN) : ?>
<div id="product_list" class="main">
    <h1 class="title">Product List</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor('products' , 'List')?></li>
        </ul>
    </div>
    <div class="search">
        <?=form::open('products/search' , array('method' => 'get'))?>
        <?
            $ar_category = Array(
                'name' => 'Name',
                'price' => 'Price',
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
            <td valign="top">
                <?=html::anchor(url::site('products') , "All")?><br />
                <?foreach ($categories as $category) :?>
                <?=html::anchor(url::site('products/index/' . $category->id) , $category->name)?><br />
                <?endforeach;?>
            </td>
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
                <?if (count($products) < 1) :?>
                    <tr class="empty">
                        <td colspan="5">No Products</td>
                    </tr>
                <?else :?>
                    <?foreach ($products as $product) :?>
                    <tr class="<?=text::alternate('odd' , 'even')?>">
                        <td><?=html::anchor('products/view/' . $product->id , $product->name)?></td>
                        <td><?=ORM::factory('category' , $product->category_id)->name?></td>
                        <td><?=$product->rating?></td>
                        <td>Rp <?=$product->price?></td>
                    </tr>
                    <?endforeach;?>
                <?endif;?>
                </tbody>
            </table></td>
        </tr>
    </table>
    <?=$pagin->render()?>
</div>
<?else :?>
<div id="product_list" class="main">
    <h1 class="title">Daftar Produk</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Kembali</a></li>
            <li><?=html::anchor('products' , 'Daftar Produk')?></li>
        </ul>
    </div>
    <div class="search">
        <?=form::open('products/search' , array('method' => 'get'))?>
        <?
            $ar_category = Array(
                'name' => 'Nama',
                'price' => 'Harga',
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
            <td valign="top">
                <?=html::anchor(url::site('products') , "Semua")?><br />
                <?foreach ($categories as $category) :?>
                <?=html::anchor(url::site('products/index/' . $category->id) , $category->name)?><br />
                <?endforeach;?>
            </td>
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
                <?if (count($products) < 1) :?>
                    <tr class="empty">
                        <td colspan="5">Tidak ada produk</td>
                    </tr>
                <?else :?>
                    <?foreach ($products as $product) :?>
                    <tr class="<?=text::alternate('odd' , 'even')?>">
                        <td><?=html::anchor('products/view/' . $product->id , $product->name)?></td>
                        <td><?=ORM::factory('category' , $product->category_id)->name?></td>
                        <td><?=$product->rating?></td>
                        <td>Rp <?=$product->price?></td>
                    </tr>
                    <?endforeach;?>
                <?endif;?>
                </tbody>
            </table></td>
        </tr>
    </table>
    <?=$pagin->render()?>
</div>
<?endif;?>