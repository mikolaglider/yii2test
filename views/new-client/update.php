<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NewClient */

$this->title = 'Update New Client: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'New Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-client-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsClientPhone' => $modelsClientPhone,
    ]) ?>

</div>
