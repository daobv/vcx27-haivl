<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Danh sách', 'url'=>array('admin')),
);
?>

<h1>Thêm mới</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>