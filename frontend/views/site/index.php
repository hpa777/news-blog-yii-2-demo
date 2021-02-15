<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */

$this->title = 'News list';

$dataProvider = new ActiveDataProvider([
   'query' => \common\models\News::find(),
   'pagination' => [
           'pageSize' => 5
   ]
]);
$css = <<< CSS
.image { 
    padding: 1em;
    height: 13em; 
}
.image img { 
    width: 100%;
    height: 100%;
    object-fit: contain; 
}
CSS;
$this->registerCss($css, ["type" => "text/css"], "myStyles" );
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Новости</h1>
    </div>

    <div class="body-content">
        <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_post',
        ]) ?>
        </div>
    </div>
</div>
