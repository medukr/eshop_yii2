<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index'], 'class' => 'breadcrumb'];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong><?php echo Yii::$app->session->getFlash('success');?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="product-view">
    <?php $image = $model->getImage() ?>


    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'name',
            'content:html',
            'price',
            'keywords',
            'description',
            [
                'attribute' => 'image',
                'value' => "<img src=\"{$image->getUrl()}\" alt=\"\">",
                'format' => 'html',
            ],
            [
                'attribute' =>  'gallery',
                'value' => function($model){
                    $images = $model->getImages();
                    $gallery = '';
                    foreach ($images as $img) {
                        $gallery .= "<img src=\"{$img->getUrl()}\" alt=\"\" width='150px'>";
                    }
                    return $gallery;
                },
                'format' => 'html',
            ],
            'hit',
            'new',
            'sale',
        ],
    ]) ?>

</div>
