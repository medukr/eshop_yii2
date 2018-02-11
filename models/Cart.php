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
                'img' => $product->img,
                'id' => $product->id,
            ];
        };

        if (isset($_SESSION['cart.qty'])){
            $_SESSION['cart.qty'] += $qty;
        }else{
            $_SESSION['cart.qty'] = $qty;
        }

        if (isset($_SESSION['cart.sum'])) {
            $_SESSION['cart.sum'] += $qty * $product->price;
        }else{
            $_SESSION['cart.sum'] = $qty * $product->price;
        }

//        $_SESSION['cart.qty'] =+ $_SESSION['cart.qty'] + $qty ?? $qty;
//        $_SESSION['cart.qty'] +=  $_SESSION['cart.qty'] + $qty ?? $qty;


//        $_SESSION['cart.qty'] = isset( $_SESSION['cart.qty']) ?  $_SESSION['cart.qty'] + $qty : $qty;
//        $_SESSION['cart.sum'] = isset( $_SESSION['cart.sum']) ?  $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;

    }

    public function recalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;
        $qtyMinus = ($_SESSION['cart'][$id]['qty']);
        $sumMinus = ($_SESSION['cart'][$id]['price']) * ($_SESSION['cart'][$id]['qty']);

        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;

        unset($_SESSION['cart'][$id]);
        if (count($_SESSION['cart']) == 0) unset($_SESSION['cart']);

    }
}