<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 29.01.18
 * Time: 11:40
 */

namespace app\models;

use rico\yii2images\models\Image;
use yii\db\ActiveRecord;

class Product extends ActiveRecord{

    public static function tableName(){
        return 'product';
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


    public static function getHitProduct () {
        return self::find()->where(['hit' => '1'])->limit(6)->all();
    }

    public static function getProductFromCategoryId($id)
    {
        return self::find()->where(['category_id' => $id])->all();
    }
}