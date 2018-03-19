<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 30.01.18
 * Time: 12:35
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\HttpException;


class CategoryController extends AppController {

    public function actionIndex () {

        $hits = Product::getHitProduct();
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }

    public function actionView ($id) {

//        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if (empty($category)) {
            throw new HttpException(404, 'Такой категории нет :\'(');
        }
//        $products = Product::getProductFromCategoryId($id);
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E-SHOPPER | '. $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('pages', 'products','category'));

    }

    public function actionSearch() {
        $search = Html::encode(trim(Yii::$app->request->get('search')));
        $this->setMeta('E-SHOPPER | Поиск: '. $search);
        if (empty($search)) return $this->render('search', compact('search'));

        $query = Product::find()->where(['like', 'name', $search]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('pages', 'products', 'search'));
    }
}