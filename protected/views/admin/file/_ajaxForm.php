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
        'id' => 'file-form',
        'enableAjaxValidation' => FALSE,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>
     <div class="row">
                    <?php echo $form->labelEx($model, 'fileId'); ?>
                    <?php echo CHtml::activeDropDownList($model, 'fileId', $listData); ?>
                    <?php echo $form->error($model, 'fileId'); ?>
                </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'Tên file'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'url_file'); ?>
        <?php echo $form->textField($model, 'url_file', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'url_file'); ?>
    </div>
   

<div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(function(){
        $("#file-form").submit(function(e){
            e.preventDefault();

            dataString = $("#file-form").serialize();
    
            $.ajax({
                type: "POST",
                url: "<?php echo $baseUrl . '/admin.php/file/create' ?>",
                data: dataString,
                dataType: "json",
                success: function (data) {
                    if (data != 1) {
                        alert('Có lỗi xảy ra, chú ý các mục có dấu *');
                    }else  {
                        $('#file-grid').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        clear_form();
                    }
                }
          
            });          
        
        });
    });
    function clear_form() {
        $("#File_name").val('');
        $("#File_file").val('');
    }
</script>

