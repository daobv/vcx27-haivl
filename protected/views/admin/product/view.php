<?php
    /* @var $this ProductController */
    /* @var $model Product */

    $this->breadcrumbs = array(
        'Products' => array('index'),
        $model->name,
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label' => 'Upload ảnh', 'url' => array('batchUpload')),
        array('label' => 'Sửa', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Xóa', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        array(
            'name'   => 'menuId',
            'value'  => isset($model->menu)?$model->menu->name:"",
        ),
        'name',
        array(
            'name'  => 'avatar',
            'value' => Yii::app()->request->baseUrl . $model->avatar,
            'type'  => 'image'
        ),
        'price',
        array(
            'name'  => 'create_time',
            'value' => date('m-d-Y',$model->create_time),
        ),
        'status',
        'home',
        'feature',
        'rank',
    ),
)); ?>
