<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);
?>

<h1>Thêm mới</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>