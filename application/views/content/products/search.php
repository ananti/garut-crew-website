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
</div>