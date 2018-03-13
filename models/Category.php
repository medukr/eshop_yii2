<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 29.01.18
 * Time: 11:31
 */

namespace app\models;

use rico\yii2images\models\Image;
use yii\db\ActiveRecord;

class Category extends ActiveRecord {

    public static function tableName(){
        return 'category';
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }


    public static function selectData () {
        return self::find()->indexBy('id')->asArray()->all();
    }
}
