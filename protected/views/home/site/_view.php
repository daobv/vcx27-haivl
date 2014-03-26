<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

$tmp_count = count($dataProvider->getData());
$tmp_i = $index + 1;
?>   
<?php if (($tmp_i + 2) % 3 == 0) { ?>
<div class="slide">
    <div class="item">
        <h3><?php echo CHtml::link($data->name, array('san-pham/' . $data->alias), array('title' => $data->name)); ?></h3>
        <a class="thumb" href="<?php echo $baseUrl . '/san-pham/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <div class="avatar-author pull-left">
            <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/avatar-default.jpg' ?>">
            <p><span class="view-post">2.634</span><span class="pull-right">6 giờ trước</span></p>            
        </div>
        <p><?php echo $data->content_1?></p>
    </div>
<?php } ?>
<?php if ((($tmp_i + 2) % 3 != 0) && ($tmp_i % 3 !=0)) {?>
     <div class="item">
        <h3><?php echo CHtml::link($data->name, array('san-pham/' . $data->alias), array('title' => $data->name)); ?></h3>
        <a class="thumb" href="<?php echo $baseUrl . '/san-pham/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <div class="avatar-author pull-left">
            <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/avatar-default.jpg' ?>">
            <p><span class="view-post">2.634</span><span class="pull-right">6 giờ trước</span></p>            
        </div>
        <p><?php echo $data->content_1?></p>
    </div>
<?php } ?>
<?php if ($tmp_i % 3 ==0) {?>
    <div class="item">
        <h3><?php echo CHtml::link($data->name, array('san-pham/' . $data->alias), array('title' => $data->name)); ?></h3>
        <a class="thumb" href="<?php echo $baseUrl . '/san-pham/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <div class="avatar-author pull-left">
            <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/avatar-default.jpg' ?>">
            <p><span class="view-post">2.634</span><span class="pull-right">6 giờ trước</span></p>            
        </div>
        <p><?php echo $data->content_1?></p>
    </div>
</div>
<?php } ?>
<?php  if (($tmp_i == $tmp_count) && ($tmp_i % 3 != 0)) {?>
</div>
<?php } ?>