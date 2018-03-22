<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = 'Обновление заказка №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index'], 'class' => 'breadcrumb'];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id], 'class' => 'breadcrumb'];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= $this->title ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
