<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = [
        'label' => 'Заказы',
        'url' => ['index'],
    'class' => 'breadcrumb'
    ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>Просмотр заказа №<?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            [
                    'attribute' => 'qty',
                    'label' => 'Кол-тво товаров',
            ],
            'sum',
            [
                'attribute' => 'status',
                'value' => !$model->status ? '<span class="text-danger">Активен</span>' : '<span class="text-success">Завершен</span>',
                'format' => 'html',
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>

    <?php $items = $model->orderItems;?>
    <div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
        <tr class="cart_menu">
            <td class="image">Item</td>
            <td class="description"></td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
               <td class="cart_product" style="margin-left: 0">
                    <a href="<?= Url::to(["/product/view", 'id' => $item->product_id])?>"><?= Html::img("@web/images/products/{$item->product['img']}", ['alt' => $item['name'], 'style' => 'width: 75px'])?></a>
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
                        <!--<a class="cart_quantity_up" href=""> + </a>-->
                        <p class="cart_quantity_input">
                            <b><?= $item['qty_item']?> шт.</b>
                        </p>
                    </div>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">$<?= $item['sum_item']?></p>
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
                <p class="art_quantity_input"><b><?= $model->qty?> шт.</b></p>
            </td>
            <td>
                <p class="cart_total_price"><b>$<?= $model->sum?></b></p>
            </td>
        </tr>
        </tbody>
    </table>

</div>
