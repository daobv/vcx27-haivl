<?php
    /* @var $this PostController */
    /* @var $model Post */

    $this->breadcrumbs = array(
        'Posts'   => array('index'),
        $model->name => array('view', 'id' => $model->id),
        'Update',
    );
?>

<h1>Sửa <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model,'listData'=>$listData)); ?>