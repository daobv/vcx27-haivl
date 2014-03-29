<?php
    /* @var $this CategoryController */
    /* @var $model Category */

    $this->breadcrumbs = array(
        'Categories' => array('index'),
        'Manage',
    );


    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Chuyên mục</h1>

<?php echo CHtml::link('Thêm mới', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_form', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->
<?php $form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'           => 'category-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'selectableRows' => 2,
    'columns'      => array(
        array(
            'id'             => 'autoId',
            'class'          => 'CCheckBoxColumn',
            'selectableRows' => '50',
        ),
        array(
            'name'        => 'id',
            'value'       => '$data->id',
            'type'        => 'raw',
            
            'filter' => FALSE,
        ),
        array(
            'name'        => 'name',
            'value'       => 'CHtml::textField("sortName[$data->id]",$data->name,array("style"=>"width:100%;"))',
            'type'        => 'raw',
        ),
        array(
            'name'        => 'rank',
            'value'       => 'CHtml::textField("sortOrder[$data->id]",$data->rank,array("style"=>"width:50px;"))',
            'type'        => 'raw',
            'htmlOptions' => array("width" => "50px"),
        ),
        array(
            'name'   => 'status',
            'value'  => '$data->status==1?"Hiện":"Ẩn"',
            'filter' => array(1 => 'Hiện', 0 => 'Ẩn'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('category-grid');
    }
</script>
<?php echo CHtml::ajaxSubmitButton('Filter', array('category/ajaxUpdate'), array(), array("style" => "display:none;")); ?>
<?php echo CHtml::ajaxSubmitButton('Hiện', array('category/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Ẩn', array('category/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Xóa', array('category/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn có chắc chắn muốn xóa những chuyên mục được chọn?")
        }',)); ?>
<?php echo CHtml::ajaxSubmitButton('Cập nhật thứ hạng', array('category/ajaxUpdate', 'act' => 'doSortOrder'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Cập nhật tên', array('category/ajaxUpdate', 'act' => 'doSortName'), array('success' => 'reloadGrid')); ?>
<?php $this->endWidget(); ?>