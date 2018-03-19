<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use Yii;
use yii\web\HttpException;


/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $user = Yii::$app->user->identity['isAdmin'];
                            if ($user === 1) return true;

                            throw new HttpException(404, 'The requested Item could not be found.');

                        }
                    ],
                ],
            ],
        ];
    }

}
