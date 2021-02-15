<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\StringHelper;

/* @var $model common\models\News */
?>

<div class="col-lg-4">
    <div class="image"><?= Html::img($model->getImageUrl()); ?></div>
    <h2><?= Html::encode($model->title) ?></h2>
    <p><?= Yii::$app->formatter->asDate($model->published_at) ?></p>
    <p><?= StringHelper::truncateWords(HtmlPurifier::process($model->content), 20, '...', false);?></p>
    <p><?= Html::a('Подробнее', ['/site/view', 'id' => $model->id], ['class' => 'btn btn-default']); ?></p>
</div>


