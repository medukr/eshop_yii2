<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $email
 * @property string $name
 * @property string $address
 * @property int $phone
 * @property string $create_at
 * @property string $update_at
 * @property int $isAdmin
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['phone', 'isAdmin'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['username', 'password', 'auth_key', 'email', 'name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'isAdmin' => 'Is Admin',
        ];
    }
}


