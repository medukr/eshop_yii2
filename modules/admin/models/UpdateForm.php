<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 20.03.18
 * Time: 16:04
 */

namespace app\modules\admin\models;
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

class UpdateForm extends \yii\db\ActiveRecord
{
//Обнуляем значения ячеек
//    public $username;
//    public $password;
//    public $email;
//    public $name;
//    public $phone;
//    public $address;
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
//            ['username', 'unique', 'targetClass' => '\app\modules\admin\models\User', 'message' => 'Этот логин уже зарезервирован.'],
            ['username', 'uniqueUpdateUsername'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\app\modules\admin\models\User', 'message' => '"Этот E-mail уже используется.'],
            ['email', 'uniqueUpdateEmail'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
//            ['secondPassword', 'string', 'min' => 6],
//            ['secondPassword', 'required'],
//            ['secondPassword', 'validateSecondPassword'],
            ['phone', 'required'],
            ['phone', 'integer', 'min' => 6],
            ['name', 'trim'],
            ['name', 'required'],
            ['address', 'trim'],
            ['address', 'string', 'max' => 255],
            ['isAdmin', 'integer'],

        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'secondPassword' => 'Повторите пароль',
            'auth_key' => 'Auth Key',
            'email' => 'E-mail',
            'name' => 'Имя',
            'address' => 'Адрес',
            'phone' => 'Тел.(формат +3801234567890)',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'isAdmin' => 'Admin',
        ];
    }

    public function updateUser()
    {
       if ($this->validate()){
           $this->setPassword();
           $this->generateAuthKey();
           $this->save(null);
       }else{
            echo 'Not valid';
            die;
        }

    }

    public function validateSecondPassword()
    {
        if ($this->password != $this->secondPassword){
            $this->addError('secondPassword', 'Повторите пароль');
        }
    }

    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public function setPassword(){
        $this->password = \Yii::$app->security->generatePasswordHash($this->password);

    }

    public function uniqueUpdateUsername(){
        $user = User::findOne(['username' =>  $this->username]);
        if ($user) {
            if ($user->id !== $this->id) {
                $this->addError('username', 'Пользователь с таким логином уже существует');
            }
        }
    }

    public function uniqueUpdateEmail(){
        $user = User::findOne(['email' =>  $this->email]);
        if ($user) {
            if ($user->id !== $this->id) {
                $this->addError('email', 'Пользователь с таким E-mail уже существует');
            }
        }
    }

}
