<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 06.02.18
 * Time: 11:22
 */

namespace app\components;


use yii\base\Widget;
use app\models\Product;
use Yii;

class RecommendedItemsWidget extends Widget{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $hits = Yii::$app->cache->get('hits');
        if ($hits) return $this->render('recommendedItems', compact('hits'));

        $hits = Product::getHitProduct();

        Yii::$app->cache->set('hits', $hits, 60);
        return $this->render('recommendedItems', compact('hits'));
    }
}