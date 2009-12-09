<?if ($lang == Controller::LANG_EN) : ?>
<div id="product_list" class="main">
    <h1 class="title">Product List</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor('administrator/products/create' , 'Create')?></li>
            <li><?=html::anchor('administrator/products' , 'List')?></li>
        </ul>
    </div>
    <table>
        <tr>
            <td valign="top">
                <?=html::anchor(url::site('administrator/products') , "All")?><br />
                <?foreach ($categories as $category) :?>
                <?=html::anchor(url::site('administrator/products/index/' . $category->id) , $category->name)?><br />
                <?endforeach;?>
            </td>
            <td><table class="list main">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Rating</th>
                        <th>Price</th>
                        <th>Action</th>
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
                        <td><?=html::anchor('administrator/products/edit/' . $product->id , "Edit")?> <span class="delete"><?=html::anchor('administrator/products/delete/' . $product->id , "Delete")?></span></td>
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
            <li><?=html::anchor('administrator/products/create' , 'Buat Produk')?></li>
            <li><?=html::anchor('administrator/products' , 'Daftar Produk')?></li>
        </ul>
    </div>
    <table>
        <tr>
            <td valign="top">
                <?=html::anchor(url::site('administrator/products') , "Semua")?><br />
                <?foreach ($categories as $category) :?>
                <?=html::anchor(url::site('administrator/products/index/' . $category->id) , $category->name)?><br />
                <?endforeach;?>
            </td>
            <td><table class="list main">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Rating</th>
                        <th>Harga</th>
                        <th>Aksi</th>
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
                        <td><?=html::anchor('administrator/products/edit/' . $product->id , "Edit")?> <span class="delete"><?=html::anchor('administrator/products/delete/' . $product->id , "Delete")?></span></td>
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