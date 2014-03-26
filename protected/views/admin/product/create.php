<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Danh sách', 'url'=>array('admin')),
);
?>

<h1>Thêm mới</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'listData'=>$listData)); ?>