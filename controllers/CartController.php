<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 06.02.18
 * Time: 14:57
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;

class CartController extends AppController{

    public function actionAdd() {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');

        if (!$qty)  $qty = 1;
//        $qty = $qty ?? 1;
        $product = Product::findOne($id);

        if (!isset($product)) return "actionAdd return false";

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addTocart($product, $qty);

        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $session->remove('cart');

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id);

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow(){
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        return $this->render('view', compact('session'));
    }
}