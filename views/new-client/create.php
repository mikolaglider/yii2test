<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NewClient */

$this->title = 'Create New Client';
$this->params['breadcrumbs'][] = ['label' => 'New Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsClientPhone' => $modelsClientPhone,
    ]) ?>

</div>
