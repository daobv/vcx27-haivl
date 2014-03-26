<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>   
<?php
$criteria = new CDbCriteria;
$criteria->compare('galleryId', $data->imgId);
$gallery = Gallery::model()->findAll($criteria);
?>
<div class="box">
    <a href="<?php echo $baseUrl . '/'.$data->menu->alias.'/' . $data->id . '/' . $data->alias . '.html' ?>">
        <?php foreach ($gallery as $gallery) { ?>
            <img alt="Agra picture" src="<?php echo $baseUrl . '/' . $gallery->image ?>">
        <?php } ?>
    </a>
    <h2><?php echo CHtml::link($data->title, array($data->menu->alias.'/'.$data->id . '-' . $data->alias)); ?></h2>
    <span><?php echo date('d-m-Y', $data->create_time); ?></span>
    <p><?php echo $data->content ?></p>
</div>