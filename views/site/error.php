<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!--<div class="site-error container">-->
<!---->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <div class="alert alert-danger">-->
<!--        --><?//= nl2br(Html::encode($message)) ?>
<!--    </div>-->
<!---->
<!--    <p>-->
<!--        The above error occurred while the Web server was processing your request.-->
<!--    </p>-->
<!--    <p>-->
<!--        Please contact us if you think this is a server error. Thank you.-->
<!--    </p>-->
<!---->
<!--</div>-->
<div class="container text-center">
    <div class="logo-404">

        <a href="<?= \yii\helpers\Url::home() ?>"><?= Html::img('@web/images/home/logo.png',['alt' => 'e-shopeer-logo']) ?></a>
    </div>
    <div class="content-404">

        <?= Html::img('@web/images/404/404.png',['class' => 'img-responsive','alt' => 'e-shopeer-404']) ?>
        <h1><b>OPPS!</b> <?= nl2br(Html::encode($message)) ?></h1>
        <p>Uh... So it looks like you brock something. The page you are looking for has up and Vanished.</p>
        <h2><a href="<?= \yii\helpers\Url::home() ?>">Bring me back Home</a></h2>
    </div>
</div>