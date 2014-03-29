<?php
    /* @var $this PostController */
    /* @var $data Post */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('menuId')); ?>:</b>
    <?php echo CHtml::encode($data->category->name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
    <?php echo CHtml::image(Yii::app()->request->baseUrl . $data->avatar); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
    <?php echo CHtml::encode($data->price); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('dateCreated')); ?>:</b>
    <?php echo CHtml::encode($data->dateCreated); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo $data->status == 1 ? 'Hiển thị' : 'Ẩn'; ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('home')); ?>:</b>
    <?php echo $data->home == 1 ? 'Hiển thị' : 'Ẩn'; ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('feature')); ?>:</b>
    <?php echo $data->feature == 1 ? 'Hiển thị' : 'Ẩn'; ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('home')); ?>:</b>
	<?php echo CHtml::encode($data->home); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feature')); ?>:</b>
	<?php echo CHtml::encode($data->feature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rank')); ?>:</b>
	<?php echo CHtml::encode($data->rank); ?>
	<br />

	*/ ?>

</div>