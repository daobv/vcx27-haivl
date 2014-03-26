<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'enableAjaxValidation' => FALSE,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'serId'); ?>
        <?php echo CHtml::activeDropDownList($model, 'serId', array('1'=>'Tin tức','2'=>'Giải pháp')); ?>
        <?php echo $form->error($model, 'serId'); ?>
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
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php
        $this->widget('ext.widgets.xheditor.XHeditor', array(
            'model' => $model,
            'modelAttribute' => 'content',
            'config' => array(
                'id' => 'xheditor_1',
                'tools' => 'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
                'skin' => 'default', // default, nostyle, o2007blue, o2007silver, vista
                'width' => '500px',
                'height' => '200px',
                'loadCSS' => XHtml::cssUrl('editor.css'),
                'upImgUrl' => $this->createUrl('request/uploadFile'),
                'upImgExt' => 'jpg,jpeg,gif,png',
            ),
        ));
        ?>
    </div>
    <?php
//    $this->widget('application.extensions.xheditor.JXHEditor', array(
//        'model' => $model,
//        'attribute' => 'content',
//        'options' => array(
//            'id' => 'xh1',
//            'name' => 'xh',
//            'tools' => 'simple', // mini, simple, full or from XHeditor::$_tools
//            'width' => '100%',
//            'skin' => 'o2007silver',
//            'emot' => 'msn',
//            'upImgUrl' => 'create' // the action name in the controller
//        //see XHeditor::$_configurableAttributes for more
//        ),
//        'htmlOptions' => array('cols' => 80, 'rows' => 20, 'style' => 'width: 50%; height: 100px;'),
//    ));
//    $this->widget('application.extensions.xheditor.JXHEditor',array(
//    'model'=>$model,
//    'attribute'=>'content',
//    'config'=>array(
//        'id'=>'xheditor_1',
//        'tools'=>'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
//        'skin'=>'default', // default, nostyle, o2007blue, o2007silver, vista
//        'width'=>'740px',
//        'height'=>'400px',
////        'loadCSS'=>XHtml::cssUrl('editor.css'),
//        'upImgUrl'=>$this->createUrl('request/uploadFile'), // NB! Access restricted by IP        'upImgExt'=>'jpg,jpeg,gif,png',
//    ),
//));
    ?>
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