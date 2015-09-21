<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeputySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Deputies');
$this->params['breadcrumbs'][] = $this->title;
$deputies=Yii::$app->db->createCommand('SELECT deputy.listorder, deputy.id, deputy.image,deputy.fullname, party.name FROM deputy LEFT JOIN party ON deputy.party_id=party.id ORDER BY deputy.listorder')->queryAll();
?>
<div class="deputy-index">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()){
        ?>
        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true" title="'.Yii::t('app', 'Add new').'"></span>', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    <?php
    }?>
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th></th>
            <th>Ф.И.О</th>
            <th>Партия</th>
        </tr>
        </thead>

    <?php
    foreach ($deputies as $deputy) {
        ?>
        <tr>
            <td><?=$deputy['listorder']?></td>
            <td>
                <?php if($deputy['image']) {
                    $img=Html::img("@web/uploads/images/".$deputy['image'], ['class'=>'deputy_image', 'alt'=>'']);
                    echo Html::a($img, Url::to(['deputy/view', 'id' =>$deputy['id']]));
                };?>
            </td>
            <td><?=Html::a($deputy['fullname'], Url::to(['deputy/view', 'id' =>$deputy['id']]));?></td>
            <td><?=$deputy['name']?></td>
        </tr>
        <?php
        }

    ?>
    </table>
</div>
