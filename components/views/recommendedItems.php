<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $i = 0; $count = count($hits); foreach ($hits as $hit): ?>
                <?php  if ($i % 3 == 0): ?>
                    <div class="item <?php if ($i == 0) echo 'active'?>">
                <?php endif; ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="<?= Url::to(['product/view','id' => $hit->id])?>">
                                    <?= Html::img("/images/products/{$hit->img}", ['alt' => $hit->name])?>
                                </a>
                                <h2>$<?= $hit->price?></h2>
                                <a href="<?= Url::to(['product/view','id' => $hit->id])?>">
                                    <p><?= $hit->name?></p>
                                </a>
                                <button type="button" class="btn btn-default add-to-cart" data-id="<?= $hit->id?>"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++ ?>
                <?php if ($i % 3 == 0 || $i == $count): ?>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->