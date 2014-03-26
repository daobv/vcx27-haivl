<?php
/* @var $this ProductController */
/* @var $model Product */
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/imageTooltip.js');
$this->breadcrumbs = array(
    'Album' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Thêm mới', 'url' => array('create'))
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
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
        ));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'album-grid',
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
            'name' => 'image',
            'value' => '"<a href=\"".Yii::app()->request->baseUrl.$data->image."\"  class=\"preview\"><img src=\"".Yii::app()->request->baseUrl.$data->image."\" width=\"50\" height=\"50\"/></a>"',
            'type' => 'raw',
            'filter' => FALSE,
            'sortable' => FALSE,
        ),
        array(
            'name' => 'name',
            'value' => 'CHtml::textField("setName[$data->id]",$data->name,array("style"=>"width:150px;"))',
            'type' => 'raw',
            'htmlOptions' => array("width" => "150px"),
        ),
        array(
            'name' => 'content',
            'value' => 'CHtml::textArea("setContent[$data->id]",$data->content,array("style"=>"width:350px;"))',
            'type' => 'raw',
            'htmlOptions' => array("width" => "350px"),
            'filter' => FALSE,
        ),
        array(
            'name' => 'rank',
            'value' => 'CHtml::textField("sortRank[$data->id]",$data->rank,array("style"=>"width:50px;"))',
            'type' => 'raw',
            'htmlOptions' => array("width" => "50px"),
        ),
        array(
            'name' => 'status',
            'value' => '$data->status==1?"Hiện":"Ẩn"',
            'filter' => array(1 => 'Hiện', 0 => 'Ẩn'),
        ),
        array(
            'name' => 'feature',
            'value' => '$data->feature==1?"Có":"Không"',
            'filter' => array(1 => 'Có', 0 => 'Không'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('album-grid');
    }
</script>
<span>Tick chọn:</span>
<?php echo CHtml::ajaxSubmitButton('Filter', array('services/ajaxUpdate'), array(), array("style" => "display:none;")); ?>
<?php echo CHtml::ajaxSubmitButton('Hiện', array('services/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Ẩn', array('services/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
|
<?php echo CHtml::ajaxSubmitButton('Nổi bật', array('services/ajaxUpdate', 'act' => 'doFeature'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Không nổi bật', array('services/ajaxUpdate', 'act' => 'doNotFeature'), array('success' => 'reloadGrid')); ?>
|
<?php echo CHtml::ajaxSubmitButton('Xóa', array('services/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn có chắc chắn muốn xóa những sản phẩm được chọn?")
        }',)); ?>
<br/><BR>
<span> Cập nhật: </span>
<?php echo CHtml::ajaxSubmitButton('Tên', array('services/ajaxUpdate', 'act' => 'doName'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Nội dung', array('services/ajaxUpdate', 'act' => 'doContent'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Thứ hạng', array('services/ajaxUpdate', 'act' => 'doSortRank'), array('success' => 'reloadGrid')); ?>
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