<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'category-form',
        'enableAjaxValidation' => TRUE,
            ));
    ?>
        <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
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
<script type="text/javascript">
    $(function(){
        $("#category-form").submit(function(e){
            e.preventDefault();

            dataString = $("#category-form").serialize();
    
            $.ajax({
                type: "POST",
                url: "<?php echo $baseUrl . '/admin.php/category/create' ?>",
                data: dataString,
                dataType: "json",
                success: function (data) {
                    if (data != 1) {
                        alert('Có lỗi xảy ra, chú ý các mục có dấu *');
                    }else  {
                        $('#category-grid').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        clear_form();
                    }
                }
          
            });          
        
        });
    });
    function clear_form() {
        $("#Category_name").val('');
    }
</script>