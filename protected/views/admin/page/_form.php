<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'page-form',
        'enableAjaxValidation' => TRUE,
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
    <table>
        <tr>
            <td>
                   <div class="row">
                    <?php echo $form->labelEx($model, 'categoryId'); ?>
                    <?php echo CHtml::activeDropDownList($model, 'categoryId', $listData); ?>
                    <?php echo $form->error($model, 'categoryId'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'title'); ?>
                    <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'imgId'); ?>
                    <?php
                    Yii::app()->clientScript->registerCoreScript('jquery');
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
                    <?php echo $form->labelEx($model, 'content'); ?>
                    <?php echo $form->textArea($model, 'content', array('style' => 'width:400px; height:100px')); ?>
                    <?php echo $form->error($model, 'content'); ?>
                </div>
                 <div class="row">
                    <?php echo $form->labelEx($model, 'home'); ?>
                    <?php echo $form->checkBox($model, 'home'); ?>
                    <?php echo $form->error($model, 'hone'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'status'); ?>
                    <?php echo $form->checkBox($model, 'status', array('value' => '1', 'checked' => 'checked')); ?>
                    <?php echo $form->error($model, 'status'); ?>
                </div>
            </td>
            <td>


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

               
            </td>
        </tr>
    </table>



    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

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

        //        uploader.bind('Init', function(up, params) {
        //            $('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
        //        });

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