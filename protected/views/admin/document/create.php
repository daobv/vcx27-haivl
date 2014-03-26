
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'document-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'doc_tab'); ?>
        <?php echo $form->dropDownList($model, 'doc_tab', array(Document::PRICE => 'Báo giá', Document::DOCUMENTSOFTWARE => 'Tài liệu - Phần mềm')); ?>
        <?php echo $form->error($model, 'doc_tab'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'doc_name'); ?>
        <?php echo $form->textField($model, 'doc_name', array('size' => 50)); ?>
        <?php echo $form->error($model, 'doc_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'doc_file'); ?>
        <?php echo $form->fileField($model, 'doc_file', array('size' => 36)); ?>
        <?php echo $form->error($model, 'doc_file'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'url_link'); ?>
        <?php echo $form->textField($model, 'url_link', array('size' => 36)); ?>
        <?php echo $form->error($model, 'url_link'); ?>
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

</div>