<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$imgId = rand();
$date = date('Ymd');
?>
<style>
    div#imgUpload, div#img{ display: none}
</style>
<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'post-form',
        'enableAjaxValidation' => TRUE,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
            ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <div id="imgUpload"></div>
    <div id="img"></div>
    <table>
        <tr>
            <td>
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
                    <?php echo $form->labelEx($model, 'Upload'); ?>
                    <div id="file">
                        <?php
                        Yii::app()->clientScript->registerCoreScript('jquery');
                        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/plupload.full.js');
                        ?>
                        <div id="container">
                            <div id="filelist"></div>
                            <a id="pickfiles" href="#">[Select files]</a>
                            <a id="uploadfiles" href="#">[Upload files]</a>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <?php echo $form->labelEx($model, 'origin'); ?>
                    <?php echo $form->textField($model, 'origin'); ?>
                </div>
                 <div class="row">
                    <?php echo $form->labelEx($model, 'content_1'); ?>
                    <?php echo $form->textArea($model, 'content_1', array('style' => 'width:400px; height:100px')); ?>
                    <?php echo $form->error($model, 'content_1'); ?>
                </div>
            </td>
            <td>
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
                            'width' => '640px',
                            'height' => '200px',
                            'loadCSS' => XHtml::cssUrl('editor.css'),
                            'upImgUrl' => $this->createUrl('request/uploadFile'),
                            'upImgExt' => 'jpg,jpeg,gif,png',
                        ),
                    ));
                    ?>
                </div>
                <?php if ($model->getScenario() != 'update') { ?>
                    <div class="row">
                        <div class="check">
                            <?php echo $form->labelEx($model, 'status'); ?>
                            <?php echo $form->checkBox($model, 'status', array('value' => '1', 'checked' => 'checked')); ?>
                        </div>
                        
                    </div>
                <?php } ?>
            </td>
        </tr>
    </table>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $(function(){
        $("#post-form").submit(function(e){
            e.preventDefault();

            dataString = $("#post-form").serialize();
    
            $.ajax({
                type: "POST",
                url: "<?php echo $baseUrl . '/admin.php/post/create' ?>",
                data: dataString,
                dataType: "json",
                success: function (data) {
                    if (data == 0) {
                        alert('Có lỗi xảy ra, chú ý các mục có dấu *');
                    }else  {
                        $('#post-grid').yiiGridView('update', {
                            data: $(this).serialize()
                        });
                        $('#imgUpload').html('');
                        $('#img').html('');
                        $('#filelist').html('');
                        clear_form();
                    }
                }
            });          
        
        });
    });
    function clear_form() {
        $("#Post_name").val('');
        $("#Post_rank").val('');
        $("#Post_home").val('');
        $("#Post_feature").val('');
        $("#Post_price").val('');
        $("#Post_origin").val('');
        $("#Post_warranty").val('');
        $("#Post_content_1").val('');
        $(".editMode").val('');
    }
</script>
<script type="text/javascript">
    // Custom example logic
    $(function() {
        var uploader = new plupload.Uploader({
            runtimes : 'gears,html5,flash,silverlight,browserplus',
            browse_button : 'pickfiles',
            container : 'container',
            max_file_size : '50mb',
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
                '<div id="' + file.id + '" class="imgItem">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
               
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
            $('#imgUpload').html('<input name="Post[imgId]" value="<?php echo $imgId ?>">');
            $('#img').html('<input name="Post[avatar]" value="upload/<?php echo $date ?>/' + file.name + '">');
        });
    });
    
  
</script>