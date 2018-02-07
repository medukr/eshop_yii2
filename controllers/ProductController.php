<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 02.02.18
 * Time: 17:41
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id){
//        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);

        if (empty($product)){
            throw new HttpException(404, 'Такого товара нет :\'(');
        }

//        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER | '. $product->name, $product->keywords, $product->description);
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
    return $this->render('view', compact('product'));
    }
}