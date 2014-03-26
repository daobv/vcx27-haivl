<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$imgId = rand();
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

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'menuId'); ?>
        <?php echo CHtml::activeDropDownList($model, 'menuId', $listData); ?>
        <?php echo $form->error($model, 'menuId'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'avatar'); ?>
        <?php echo $form->fileField($model, 'avatar'); ?>
        <?php echo $form->error($model, 'avatar'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price'); ?>
        <?php echo $form->error($model, 'price'); ?>
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
                'width' => '740px',
                'height' => '400px',
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

        <?php echo $form->labelEx($model, 'home'); ?>
        <?php echo $form->checkBox($model, 'home'); ?>
        
        <?php echo $form->labelEx($model, 'feature'); ?>
        <?php echo $form->checkBox($model, 'feature'); ?>
        
        <?php echo $form->labelEx($model, 'rank'); ?>
        <?php echo $form->textField($model, 'rank'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(function(){
        $("#product-form").submit(function(e){
            e.preventDefault();

            dataString = $("#product-form").serialize();
    
            $.ajax({
                type: "POST",
                url: "<?php echo $baseUrl . '/admin.php/product/create' ?>",
                data: dataString,
                dataType: "json",
                success: function (data) {
                    $('#product-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                }
          
            });          
        
        });
    });
</script>
<script type="text/javascript">
    // Custom example logic
    $(function() {
        var uploader = new plupload.Uploader({
            runtimes : 'gears,html5,flash,silverlight,browserplus',
            browse_button : 'pickfiles',
            container : 'container',
            max_file_size : '10mb',
            url : '<?php echo $this->createUrl('upload', array('galleryId' => $imgId)) ?>',
            flash_swf_url : '/plupload/js/plupload.flash.swf',
            silverlight_xap_url : '/plupload/js/plupload.silverlight.xap',
            filters : [
                {title : "Image files", extensions : "jpg,gif,png"},
                {title : "Zip files", extensions : "zip"}
            ],
            resize : {width : 320, height : 240, quality : 90}
        });
        $('#uploadfiles').click(function(e) {
            uploader.start();
            e.preventDefault();
        });

        uploader.init();

        uploader.bind('FilesAdded', function(up, files) {
            $.each(files, function(i, file) {
                $('#filelist').append(
                '<div id="' + file.id + '" style="float:left" class="dele">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
                $('#imgUpload').append('<input name="Page[imgId]" value="<?php echo $imgId ?>">');
            });

            up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('UploadProgress', function(up, file) {  
            $('#' + file.id+" b").html(file.percent + "%");
        });

        uploader.bind('Error', function(up, err) {
            $('#filelist').append("<div>Error: " + err.code +
                ", Message: " + err.message +
                (err.file ? ", File: " + err.file.name : "") +
                "</div>"
        );

            up.refresh(); // Reposition Flash/Silverlight
        });

        uploader.bind('FileUploaded', function(up, file) {
            $('#' + file.id + " b").html("100%");
        });
    });
    
  
</script>