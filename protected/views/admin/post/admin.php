<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

$this->breadcrumbs = array(
    'Posts' => array('index'),
    'Manage',
);


Yii::app()->clientScript->registerScript('create', "
$('.create-button').click(function(){
	$('.create-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Thêm mới', '#', array('class' => 'create-button')); ?>
<div class="create-form" style="display:none">
    <?php
    $this->renderPartial('_form', array(
        'model' => $model,
        'listData' => $listData
    ));
    ?>
</div>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
        ));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'post-grid',
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
            'name' => 'avatar',
            'value' => '"<img src=\"".Yii::app()->request->baseUrl."/".$data->avatar."\" width=\"50\" height=\"50\"/>"',
            'type' => 'raw',
            'filter' => FALSE,
            'sortable' => FALSE,
        ),
        array(
            'name' => 'menuId',
            'value' => 'isset($data->menu)?$data->menu->name:""',
            'filter' => CHtml::activeDropDownList($model, 'menuId', $listData),
        ),
        array(
            'name' => 'name',
            'value' => 'CHtml::textField("setName[$data->id]",$data->name,array("style"=>"width:200px;"))',
            'type' => 'raw',
        ),
        array(
            'name' => 'content_1',
            'value' => 'CHtml::textArea("setContent1[$data->id]",$data->content_1,array("style"=>"width:200px;"))',
            'type' => 'raw',
        ),
        
        array(
            'name' => 'origin',
            'value' => 'CHtml::textField("setOrigin[$data->id]",$data->origin)',
            'type' => 'raw',
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
        $.fn.yiiGridView.update('post-grid');
    }
</script>
<div class="button-bottom">
    <span>Tick chọn:</span>
    <?php echo CHtml::ajaxSubmitButton('Filter', array('post/ajaxUpdate'), array(), array("style" => "display:none;")); ?>
    <?php echo CHtml::ajaxSubmitButton('Hiện', array('post/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Ẩn', array('post/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
    <span>Sản phẩm KM: </span>
    <?php echo CHtml::ajaxSubmitButton('Chọn', array('post/ajaxUpdate', 'act' => 'doHome'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Bỏ chọn', array('post/ajaxUpdate', 'act' => 'doNotHome'), array('success' => 'reloadGrid')); ?>
    <span>Sản phẩm BC</span>
    <?php echo CHtml::ajaxSubmitButton('Chọn', array('post/ajaxUpdate', 'act' => 'doFeature'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Bỏ chọn', array('post/ajaxUpdate', 'act' => 'doNotFeature'), array('success' => 'reloadGrid')); ?>
    <span>Xóa</span>
    <?php echo CHtml::ajaxSubmitButton('Xóa', array('post/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn có chắc chắn muốn xóa những sản phẩm được chọn?")
        }',)); ?>
    <span>Cập nhật: </span>
    <?php echo CHtml::ajaxSubmitButton('Tên', array('post/ajaxUpdate', 'act' => 'doName'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Thứ hạng', array('post/ajaxUpdate', 'act' => 'doSortRank'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Giá', array('post/ajaxUpdate', 'act' => 'doPrice'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Bảo hành', array('post/ajaxUpdate', 'act' => 'doWarranty'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Xuất xứ', array('post/ajaxUpdate', 'act' => 'doOrigin'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Nội dung tóm tắt', array('post/ajaxUpdate', 'act' => 'doContent1'), array('success' => 'reloadGrid')); ?>
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