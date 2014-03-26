<?php
    /* @var $this ProductController */
    /* @var $model Product */

    $this->breadcrumbs = array(
        'Products'   => array('index'),
        $model->name => array('view', 'id' => $model->id),
        'Update',
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label' => 'Upload ảnh', 'url' => array('batchUpload')),
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>Sửa <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>