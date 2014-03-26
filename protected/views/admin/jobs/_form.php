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
        <?php echo $form->labelEx($model, 'categoryId'); ?>
        <?php echo $form->dropDownList($model, 'categoryId', CHtml::listData(Category::model()->findAll(), 'id', 'name')) ?>
        <?php echo $form->error($model, 'categoryId'); ?>
    </div>

    <?php
    if ($model->getScenario() != 'update') {
        ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'location'); ?>
            <?php echo $form->textField($model, 'location', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'location'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'gender'); ?>
            <?php echo $form->dropDownList($model, 'gender', array('1' => 'Nam', '2' => 'Nữ', '0' => 'Nam/Nữ')); ?>
            <?php echo $form->error($model, 'gender'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'update_time'); ?>
            <?php
            echo $form->textField($model, 'update_time', array('size' => 30, 'maxlength' => 255, 'value' => '00-00-0000'));
            ?>
            <?php echo $form->error($model, 'update_time'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'wage'); ?>
            <?php echo $form->textField($model, 'wage', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'wage'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'job_type'); ?>
            <?php echo $form->textField($model, 'job_type', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'job_type'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'probation_period'); ?>
            <?php
            echo CHtml::dropDownList('probation_period', $model, array('1 tháng' => '1 tháng', '2 tháng' => '2 tháng', '3 tháng' => '3 tháng'));
            ?>
            <?php echo $form->error($model, 'probation_period'); ?>
        </div>
    <?php } ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'education'); ?>
        <?php
        echo CHtml::dropDownList('Jobs[education]', $model, array(Jobs::JOB_UNIVERSITY => 'Đại học', Jobs::JOB_COLLEGE => 'Cao Đẳng', Jobs::JOB_INTERMEDIATE => ' Trung cấp', Jobs::JOB_GENERAL => 'Lao động phổ thông'));
        ?>
        <?php echo $form->error($model, 'wage'); ?>
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
                'width' => '450px',
                'height' => '150px',
                'loadCSS' => XHtml::cssUrl('editor.css'),
                'upImgUrl' => $this->createUrl('request/uploadFile'),
                'upImgExt' => 'jpg,jpeg,gif,png',
            ),
        ));
        ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'skills'); ?>
        <?php
        $this->widget('ext.widgets.xheditor.XHeditor', array(
            'model' => $model,
            'modelAttribute' => 'skills',
            'config' => array(
                'id' => 'xheditor_2',
                'tools' => 'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
                'skin' => 'default', // default, nostyle, o2007blue, o2007silver, vista
                'width' => '450px',
                'height' => '150px',
                'loadCSS' => XHtml::cssUrl('editor.css'),
                'upImgUrl' => $this->createUrl('request/uploadFile'),
                'upImgExt' => 'jpg,jpeg,gif,png',
            ),
        ));
        ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'mode'); ?>
        <?php
        $this->widget('ext.widgets.xheditor.XHeditor', array(
            'model' => $model,
            'modelAttribute' => 'mode',
            'config' => array(
                'id' => 'xheditor_3',
                'tools' => 'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
                'skin' => 'default', // default, nostyle, o2007blue, o2007silver, vista
                'width' => '450px',
                'height' => '150px',
                'loadCSS' => XHtml::cssUrl('editor.css'),
                'upImgUrl' => $this->createUrl('request/uploadFile'),
                'upImgExt' => 'jpg,jpeg,gif,png',
            ),
        ));
        ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'required'); ?>
        <?php
        $this->widget('ext.widgets.xheditor.XHeditor', array(
            'model' => $model,
            'modelAttribute' => 'required',
            'config' => array(
                'id' => 'xheditor_4',
                'tools' => 'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
                'skin' => 'default', // default, nostyle, o2007blue, o2007silver, vista
                'width' => '450px',
                'height' => '150px',
                'loadCSS' => XHtml::cssUrl('editor.css'),
                'upImgUrl' => $this->createUrl('request/uploadFile'),
                'upImgExt' => 'jpg,jpeg,gif,png',
            ),
        ));
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->checkBox($model, 'status', array('value' => '1', 'checked' => 'checked')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->