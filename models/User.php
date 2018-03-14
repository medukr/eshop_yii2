<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $isAdmin;
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $email
 * @property string $name
 * @property string $address
 * @property int $phone
 * @property string $create_at
 * @property string $update_at
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName(){
       return '{{%user}}';
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

//        return static::findOne(['access_token' => $token]);

//        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//        return $this->password === $password;
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password){
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
