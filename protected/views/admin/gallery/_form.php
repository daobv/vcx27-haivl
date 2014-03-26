<?php
    /* @var $this ProductController */
    /* @var $model Product */
    /* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'product-form',
    'enableAjaxValidation' => FALSE,
    'htmlOptions'          => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'albumId'); ?>
        <?php echo $form->dropDownList($model, 'albumId', CHtml::listData(Album::model()->findAll(), 'id', 'name')) ?>
        <?php echo $form->error($model, 'albumId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'image'); ?>
        <?php echo $form->fileField($model, 'image'); ?>
        <?php echo $form->error($model, 'image'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->checkBox($model, 'status'); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'feature'); ?>
        <?php echo $form->checkBox($model, 'feature'); ?>
        <?php echo $form->error($model, 'feature'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'rank'); ?>
        <?php echo $form->textField($model, 'rank'); ?>
        <?php echo $form->error($model, 'rank'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->