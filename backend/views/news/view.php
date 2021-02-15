<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

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
            'title',
            'content:ntext',
            [
                'attribute' => 'image',
                'value' => $model->getImageUrl(),
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            [
                'attribute' => 'published_at',
                'format' => ['date']
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date']
            ],
            [
                'label' => 'Пользователь',
                'value' => $model->user->username
            ]
        ],
    ]) ?>

</div>
