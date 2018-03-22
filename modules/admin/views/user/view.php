<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <h1>Пользователь: <?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            //'password',
            //'auth_key',
            'email:email',
            'name',
            'address',
            'phone',
            'create_at',
            'update_at',
            //'isAdmin',
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
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<!--
    * @property int $id
    * @property int $user_id
    * @property string $created_at
    * @property string $updated_at
    * @property int $qty
    * @property double $sum
    * @property string $status
    * @property string $name
    * @property string $email
    * @property string $phone
    * @property string $address-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'sum',
            'status',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($key, $index, $column) {
                        $url = "@web/admin/order/update/$index->id";
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,[
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                    'view' => function ($key, $index, $column) {
                        $url = "@web/admin/order/$index->id";
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,[
                            'title' => Yii::t('yii', 'View'),
                        ]);
                    },
                    'delete' => function ($key, $index, $column) {
                        $url = "@web/admin/user/orderdelete/$index->id";
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,[
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
