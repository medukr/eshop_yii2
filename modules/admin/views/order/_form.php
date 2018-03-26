<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="order-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <?php // echo $form->field($model, 'qty')->textInput() ?>

    <?php // echo $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Активен', '1' => 'Завершен' ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true ]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true ]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true ]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="orderItems">
        <a href="#" class="btn btn-success" id="showOrderItems" data-id="<?= $model->id?>">Show Order Items</a>
    </div>



</div>
