<?php
    /* @var $this CategoryController */
    /* @var $model Category */

    $this->breadcrumbs = array(
        'Categories' => array('index'),
        $model->name,
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label' => 'Sửa', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Xóa', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>Chuyên mục #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        array(
            'name'  => 'parentId',
            'value' => isset($model->parent) ? $model->parent->name : '',
        ),
        'name',
        'rank',
        array(
            'name'  => 'status',
            'value' => $model->status == 1 ? "Hiện" : "Ẩn",
        ),
    ),
)); ?>
