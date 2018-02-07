<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 29.01.18
 * Time: 11:31
 */

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord {

    public static function tableName(){
        return 'category';
    }

    public function getProducts() {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public static function selectData () {
        return self::find()->indexBy('id')->asArray()->all();
    }
}
