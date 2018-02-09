<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 06.02.18
 * Time: 15:02
 */

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord {

    public function addTocart(Product $product, $qty = 1)
    {
        if (isset($_SESSION['cart'][$product->id])){

            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
//        $_SESSION['cart.qty'] = isset( $_SESSION['cart.qty']) ?  $_SESSION['cart.qty'] + $qty : $qty;
//        $_SESSION['cart.sum'] = isset( $_SESSION['cart.sum']) ?  $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;

    }
}