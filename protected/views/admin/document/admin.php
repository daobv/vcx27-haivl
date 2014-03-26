<?php
/* @var $this ProductController */
/* @var $model Product */
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/imageTooltip.js');
$this->breadcrumbs = array(
    'Danh mục' => array('/danh-muc'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Thêm mới', 'url' => array('document/create')),
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
?>

<h1>Danh sách</h1>

<?php echo CHtml::link('Tìm kiếm', '#', array('class' => 'search-button')); ?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
        ));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'document-grid',
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
            'name' => 'doc_tab',
            'value' => function($data) {
                if ($data->doc_tab == Document::PRICE)
                    $item = 'Báo giá';
                else
                    $item = 'Tài liệu - phần mềm';
                return $item;
            },
            'filter' => array(Document::PRICE => 'Báo giá', Document::DOCUMENTSOFTWARE => 'Tài liệu'),
        ),
        array(
            'name' => 'doc_name',
            'value' => 'CHtml::textField("setName[$data->id]",$data->doc_name,array("style"=>"width:150px;"))',
            'type' => 'raw',
            'htmlOptions' => array("width" => "150px"),
        ),
        'doc_file',
        'doc_type',
        array(
            'name' => 'doc_size',
            'value' => '$data->doc_size',
        ),
        array(// display 'create_time' using an expression
            'name' => 'create_time',
            'value' => 'date("d-m-Y", $data->create_time)',
        ),
        array(
            'name' => 'status',
            'value' => '$data->status==1?"Hiện":"Ẩn"',
            'filter' => array(1 => 'Hiện', 0 => 'Ẩn'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('document-grid');
    }
</script>
<span>Tick chọn:</span>
<?php echo CHtml::ajaxSubmitButton('Hiện', array('document/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Ẩn', array('document/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
<br/>
<span>Không cần tick chọn: </span>
<?php echo CHtml::ajaxSubmitButton('Cập nhật tên', array('document/ajaxUpdate', 'act' => 'doName'), array('success' => 'reloadGrid')); ?>
|
<?php echo CHtml::ajaxSubmitButton('Xóa', array('product/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn có chắc chắn muốn xóa những sản phẩm được chọn?")
        }',)); ?>
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