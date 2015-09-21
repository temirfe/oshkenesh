<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .gal_enter{  display: table-cell;
        height: 144px;
        vertical-align: middle;}
    .gthumb {
        margin-right: 40px;
    }
    article.item {
        display: table;
    }
</style>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_list_item',['model' => $model]);

            // or just do some echo
            // return $model->title . ' posted by ' . $model->author;
        },
    ]) ?>

</div>
