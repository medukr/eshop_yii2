<?php

namespace app\models;

use Yii;

use app\models\User;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $secondPassword
 * @property string $auth_key
 * @property string $email
 * @property string $name
 * @property string $address
 * @property int $phone
 * @property string $create_at
 * @property string $update_at
 */
class RegisterForm extends \yii\db\ActiveRecord
{

    public $username;
    public $password;
    public $email;
    public $name;
    public $phone;
    public $address;
    public $secondPassword;

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
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот логин уже зарезервирован.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => '"Это E-mail уже используется.'],
            [['username', 'password'], 'required'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['secondPassword', 'validateSecondPassword'],
            ['phone', 'required'],
            ['phone', 'integer', 'min' => 6],
            ['name', 'trim'],
            ['name', 'required'],
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
            'secondPassword' => 'secondPassword',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    public function registerUser()
    {
        if (!$this->validate()){
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->phone = $this->phone;
        return $user->save() ? $user : null;


    }

    public function validateSecondPassword()
    {
        if ($this->password != $this->secondPassword){
            $this->addError('secondPassword', 'Повторите пароль');
        }
    }
}
