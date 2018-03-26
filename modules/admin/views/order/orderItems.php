<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
        <tr class="cart_menu">
            <td class="image">Item</td>
            <td class="description"></td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
            <td><i class="fa fa-times"></i></td>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($model as $id => $item): ?>
            <tr>
                <td class="cart_product" style="margin-left: 0">
                    <a href="<?= Url::to(["/product/view", 'id' => $item->product_id])?>"><?= Html::img("@web/images/products/{$item->product->img}", ['alt' => $item->name, 'style' => 'width: 75px'])?></a>
                </td>

                <td class="cart_description">
                    <h4><a href="<?= Url::to(["/product/view", 'id' => $item->product_id])?>"><?= $item['name']?></a></h4>

                    <p>Web ID: <?= $item->product_id?></p>
                </td>

                <td class="cart_price">
                    <p>$<?= $item['price']?></p>
                </td>

                <td class="cart_quantity" >
                    <div class="cart_quantity_button">
                        <a class="cart_quantity_up item_quantity" data-id="<?= $item->id?>" data-order="<?= $item->order_id?>" data-action="plus" href="#"> + </a>
                        <div class="cart_quantity_input">
                           <p><b><?= $item->qty_item?></b></p>
                        </div>
                        <a class="cart_quantity_down item_quantity" data-id="<?= $item->id?>" data-order="<?= $item->order_id?>" data-action="minus" href=""> - </a>
                    </div>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">$<?= $item->sum_item?></p>
                </td>

                <td class="cart_delete">
                    <a class="cart_quantity_delete item_quantity <!--del-item-->" href="" data-id="<?= $item->id?>" data-order="<?= $item->order_id ?>" data-action="delete"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>


        <tr bgcolor="#dcdcdc">
            <td>

            </td>
            <td colspan="2" class="cart_description">
                <h3>Итого:</h3>
            </td>
            <td>
                <p class="art_quantity_input total_quantity"><b><?= $order->qty?> шт.</b></p>
            </td>
            <td colspan="2">
                <p class="cart_total_price total_price"><b>$<?= $order->sum?></b></p>
            </td>
        </tr>
        </tbody>
    </table>
    <div>
        <h4>Довавить товар</h4>
        <label for="newitem">ID:</label>
        <input type="text" name="newitem" class="id_new_item" placeholder="Введите ID товара">
        <a href="#"class="btn btn-success add_order_item" data-order="<?= $order->id?>">Добавить</a>
    </div>
</div>