<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'name',
            'address',
            'phone',
            [
              'attribute' => 'isAdmin',
              'label' => 'Статус',
              'value' =>  function($data){
                    if ($data->isAdmin === 1){
                        return '<span class="text-danger">Администратор</span>';
                    }

                    return '<span class="text-success">Пользователь</span>';
                },
                'filter' => ['1' => 'Администратор', '0' => 'Пользователь'],
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
