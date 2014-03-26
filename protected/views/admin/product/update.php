<?php
    /* @var $this ProductController */
    /* @var $model Product */

    $this->breadcrumbs = array(
        'Products'   => array('index'),
        $model->name => array('view', 'id' => $model->id),
        'Update',
    );
?>

<h1>Sửa <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model,'listData'=>$listData)); ?>