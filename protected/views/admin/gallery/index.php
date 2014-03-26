<?php
    /* @var $this ProductController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs = array(
        'Products',
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label' => 'Batch Upload', 'url' => array('batchUpload')),
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
