<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', [
        'model' => $searchModel,
        ]); 
    ?>

    <p>
        <?= Html::a('Create New Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'lastname',
            'name',
            'middlename',
            'birthday',
            'sex',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
