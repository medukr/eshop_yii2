<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegisterForm */
/* @var $form ActiveForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="site-register container">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password') ?>

            <?= $form->field($model, 'secondPassword') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'address') ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div><!-- site-register -->
