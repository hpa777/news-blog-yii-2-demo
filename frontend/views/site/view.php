<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\StringHelper;

/* @var $model common\models\News */
?>

<div class="site-index">

    <div class="jumbotron">
        <h1><?= Html::encode($model->title) ?></h1>
    </div>

    <div class="body-content">
        <p><?= Yii::$app->formatter->asDate($model->published_at) ?></p>
        <p><?= HtmlPurifier::process($model->content); ?></p>
        <div class="image"><?= Html::img($model->getImageUrl()); ?></div>
    </div>
</div>