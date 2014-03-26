<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'page-form',
        'enableAjaxValidation' => FALSE,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
    $imgId = rand();
    echo $form->hiddenField($model, 'imgId', array('value' => $imgId));
    ?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'menuId'); ?>
                    <?php echo CHtml::activeDropDownList($model, 'menuId', $listData); ?>
                    <?php echo $form->error($model, 'menuId'); ?>
                </div>
  <div class="row">
                    <?php echo $form->labelEx($model, 'imgId'); ?>
                    <?php
                    Yii::app()->clientScript->registerCoreScript('jquery');
//        Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/js/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css');
//        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js');
                    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/plupload.full.js');
                    ?>
                    <div id="container">
                        <div id="filelist"></div>
                        <a id="pickfiles" href="#">[Select files]</a>
                        <a id="uploadfiles" href="#">[Upload files]</a>
                    </div>
                    <!--<div id="uploader">You browser doesn't have HTML 4 support.</div>-->
                </div>

                 <div class="row">
                    <?php echo $form->labelEx($model, 'content_1'); ?>
                    <?php
                    $this->widget('ext.widgets.xheditor.XHeditor', array(
                        'model' => $model,
                        'modelAttribute' => 'content_1',
                        'config' => array(
                            'id' => 'xheditor_1',
                            'tools' => 'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
                            'skin' => 'default', // default, nostyle, o2007blue, o2007silver, vista
                            'width' => '600px',
                            'height' => '200px',
                            'loadCSS' => XHtml::cssUrl('editor.css'),
                            'upImgUrl' => $this->createUrl('request/uploadFile'),
                            'upImgExt' => 'jpg,jpeg,gif,png',
                        ),
                    ));
                    ?>
                </div>




    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

