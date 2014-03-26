<?php
    /* @var $this ProductController */
    /* @var $model Product */

    $this->breadcrumbs = array(
        'Danh mục tuyển dụng'   => array('index'),
        $model->location => array('view', 'id' => $model->id),
        'Update',
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>Cập nhật <?php echo $model->location; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>