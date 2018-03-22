
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="cart_items">
    <div class="container">
        <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong><?php echo Yii::$app->session->getFlash('success');?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong><?php echo Yii::$app->session->getFlash('error');?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (isset($session['cart'])) : ?>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
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
                <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td class="cart_product">
                        <a href="<?= Url::to(["product/view", 'id' => $id])?>"><?= Html::img("{$item['img']}", ['alt' => $item['name'], 'width' => '150px'])?></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="<?= Url::to(["product/view", 'id' => $id])?>"><?= $item['name']?></a></h4>
                        <p>Web ID: <?= $id?></p>
                    </td>
                    <td class="cart_price">
                        <p>$<?= $item['price']?></p>
                    </td>
                    <td class="cart_quantity" >
                        <div class="cart_quantity_button">
                            <!--<a class="cart_quantity_up" href=""> + </a>-->
                            <p class="cart_quantity_input">
                               <b><?= $item['qty']?> шт.</b>
                            </p>
                          <!--  <input class="cart_quantity_input" type="text" name="quantity" value="<?/*= $item['qty']*/?>" autocomplete="off" size="2">-->
                           <!-- <a class="cart_quantity_down" href=""> - </a>-->
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">$<?= $item['qty']*$item['price']?></p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete del-item" href="" data-id="<?= $id?>"><i class="fa fa-times"></i></a>
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
                        <p class="art_quantity_input"><b><?= $session['cart.qty']?> шт.</b></p>
                    </td>
                    <td>
                        <p class="cart_total_price"><b>$<?= $session['cart.sum']?></b></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <?php $form = ActiveForm::begin() ?>
                    <!--<ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>-->
                    <?= $form->field($order,'name')?>
                    <?= $form->field($order,'email')?>
                    <?= $form->field($order,'phone')?>
                    <?= $form->field($order,'address')?>

                   <!-- <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>-->
                    <?= Html::submitButton('Заказать', ['class' => "btn btn-default check_out"])?>
                   <!-- <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>-->
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <!--<div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>$61</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>-->
        </div>
    </div>
</section><!--/#do_action-->
<?php else: ?>
<section id="cart_items">
    <div class="container">
        <h2>Корзина пуста</h2>
    </div>
</section>
<?php endif; ?>

