<?php
    /* @var $this PostController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs = array(
        'Posts',
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label' => 'Batch Upload', 'url' => array('batchUpload')),
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>Posts</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
