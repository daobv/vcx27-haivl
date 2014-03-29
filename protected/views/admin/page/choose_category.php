<?php
    /**
     * Created by $Mitonios Editor.
     * User: $Mitonios
     * Date: 28/02/13
     * Time: 4:05 PM
     */
    /* @var $form CActiveForm */
    $this->breadcrumbs = array(
        'Posts' => array('index'),
        'Batch Upload',
        'Choose Category',
    );

    $this->menu = array(
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>

<h1>Chọn chuyên mục</h1>
<p>Vui lòng chọn chuyên mục bạn muốn upload hàng loạt vào.</p>
<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'post-form',
    'enableAjaxValidation' => FALSE,
    'htmlOptions'          => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

    <div class="row">
        <label>Chọn chuyên mục</label>
        <?php echo CHtml::dropDownList('categoryId', '', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Bước 2'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
