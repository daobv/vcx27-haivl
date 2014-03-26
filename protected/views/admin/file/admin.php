<style>
    div#file,div#link {display:none; margin-left: 110px; margin-top: 10px; }
</style>
<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/imageTooltip.js');
$this->breadcrumbs = array(
    'Page' => array('index'),
    'Danh sách',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('create', "
$('.create-button').click(function(){
	$('.create-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Thêm mới', '#', array('class' => 'create-button')); ?>
<div class="create-form" style="display:none">
    <a href="#" id="show">Chọn file từ máy bạn</a> | 
    <a href="#" id="hide">Copy URL</a>
    <div id ="file">
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/plupload.full.js');
        ?>
        <div id="container">
            <div id="filelist"></div>
            <a id="pickfiles" href="#">[Select files]</a>
            <a id="uploadfiles" href="#">[Upload files]</a>
        </div>
    </div>
    <div id="link">
        <?php
        $this->renderPartial('_ajaxForm', array(
            'model' => $model,
            'listData' => $listData
        ));
        ?>
    </div>
    <script>
        $("#show").click(function () {
            $("div#file").first().show("fast", function showNext() {
                $(this).next("div#file").show("fast", showNext);
            });
            $("div#link").hide(1000);
        });
        $("#hide").click(function () {
            $("div#link").show();
            $("div#file").hide(1000);
        });
    </script>
</div>

<?php
$baseUrl = Yii::app()->request->baseUrl;
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
        ));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'file-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    'columns' => array(
        array(
            'id' => 'autoId',
            'class' => 'CCheckBoxColumn',
            'selectableRows' => '50',
        ),
        array(
            'name' => 'fileId',
            'value' => function($data) {
                if ($data->fileId == File::QUOTE) {
                    $item = 'Báo giá';
                } elseif ($data->fileId == File::DS) {
                    $item = 'Tài liệu - Phần mền';
                } else {
                    $item = 'Chưa chọn';
                }
                return $item;
            },
            'type' => 'raw',
            'filter' => CHtml::activeDropDownList($model, 'fileId', $listData),
        ),
        array(
            'name' => 'name',
            'value' => 'CHtml::textField("setName[$data->id]",$data->name,array("style"=>"width:100%;"))',
            'type' => 'raw',
        ),
        array(
            'name' => 'File',
            'value' => function($data) {
                if (!empty($data->file)) {
                    $item = $data->file;
                } elseif (!empty($data->url_file)) {
                    $item = $data->url_file;
                } elseif (!empty($data->file) and !empty($data->url_file)) {
                    $item = $data->file;
                } else {
                    $item = 'No file';
                }
                return $item;
            },
            'type' => 'raw',
            'filter' => FALSE,
            'sortable' => FALSE,
        ),
        array(
            'name' => 'status',
            'value' => '$data->status==1?"Hiện":"Ẩn"',
            'filter' => array(1 => 'Hiện', 0 => 'Ẩn'),
            'htmlOptions' => array("width" => "50px"),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
        ),
    ),
));
?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('file-grid');
    }
</script>
<div class="button-bottom">
    <span>Tick chọn:</span>
    <?php echo CHtml::ajaxSubmitButton('Hiện', array('file/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Ẩn', array('file/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Báo giá', array('file/ajaxUpdate', 'act' => 'doBg'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Tài liệu', array('file/ajaxUpdate', 'act' => 'doTl'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Xóa', array('file/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn có chắc chắn muốn xóa những sản phẩm được chọn?")
        }',)); ?>
    <span> Cập nhật: </span>
    <?php echo CHtml::ajaxSubmitButton('Tên', array('file/ajaxUpdate', 'act' => 'doName'), array('success' => 'reloadGrid')); ?>
</div>
<?php $this->endWidget(); ?>

<style>
    #preview {
        position: absolute;
        border: 1px solid #ccc;
        background: #333;
        padding: 5px;
        display: none;
        color: #fff;
    }

    #preview img {
        max-width: 500px;
        max-height: 500px;
    }
</style>

<script type="text/javascript">
    // Custom example logic
    $(function() {
        var uploader = new plupload.Uploader({
            runtimes : 'gears,html5,flash,silverlight,browserplus',
            browse_button : 'pickfiles',
            container : 'container',
            max_file_size : '100mb',
            url : '<?php echo $this->createUrl('upload') ?>',
            flash_swf_url : '/plupload/js/plupload.flash.swf',
            silverlight_xap_url : '/plupload/js/plupload.silverlight.xap',
            filters : [
                {title : "Image files", extensions : "jpg,gif,png"},
                {title : "Zip files", extensions : "zip,rar,doc,docx,pdf"}
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
            $('#file-grid').yiiGridView('update', {
                data: $(this).serialize()
            });
        });
    });
    
  
</script>