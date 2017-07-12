<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\NewClient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-client-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model,'sex')->radiolist(['male' => 'Male', 'female' => 'Female'])->label(false) ?>

    <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-phone"></i> Phones</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsClientPhone[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'phone',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsClientPhone as $i => $modelClientPhone): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <!-- <h3 class="panel-title pull-left">Phone</h3> -->
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelClientPhone->isNewRecord) {
                                echo Html::activeHiddenInput($modelClientPhone, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelClientPhone, "[{$i}]phone")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
