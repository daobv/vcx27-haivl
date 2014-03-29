<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

$tmp_count = count($dataProvider->getData());
$tmp_i = $index + 1;

// $tmp_new = User::model()->find("id = '$data->user_id'");
$tmp_new = User::model()->findByPk($data->user_id);
$tmp_user_meta = $tmp_new->user_meta;

?>   
<?php if (($tmp_i + 2) % 3 == 0) { ?>
<div class="slide">
    <div class="item">
        <h3><?php echo CHtml::link($data->name, array('bai-viet/' . $data->alias), array('title' => $data->name)); ?></h3>
        <a class="thumb" href="<?php echo $baseUrl . '/bai-viet/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <div class="avatar-author pull-left">
            <img class="pull-left" src="<?php echo $baseUrl . '/' . $tmp_user_meta->avatar; ?>">
            <p><span class="view-post"><?php echo Post::model()->adddotString($data->post_view);?></span><span class="pull-right"><?php echo Post::model()->checkTime($data->create_time); ?></span></p>            
        </div>
        <p><?php echo $data->content_1?></p>
    </div>
<?php } ?>
<?php if ((($tmp_i + 2) % 3 != 0) && ($tmp_i % 3 !=0)) {?>
     <div class="item">
        <h3><?php echo CHtml::link($data->name, array('bai-viet/' . $data->alias), array('title' => $data->name)); ?></h3>
        <a class="thumb" href="<?php echo $baseUrl . '/bai-viet/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <div class="avatar-author pull-left">
            <img class="pull-left" src="<?php echo $baseUrl . '/' . $tmp_user_meta->avatar; ?>">
            <p><span class="view-post"><?php echo Post::model()->adddotString($data->post_view);?></span><span class="pull-right"><?php echo Post::model()->checkTime($data->create_time); ?></span></p>            
        </div>
        <p><?php echo $data->content_1?></p>
    </div>
<?php } ?>
<?php if ($tmp_i % 3 ==0) {?>
    <div class="item">
        <h3><?php echo CHtml::link($data->name, array('bai-viet/' . $data->alias), array('title' => $data->name)); ?></h3>
        <a class="thumb" href="<?php echo $baseUrl . '/bai-viet/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <div class="avatar-author pull-left">
            <img class="pull-left" src="<?php echo $baseUrl . '/' . $tmp_user_meta->avatar; ?>">
            <p><span class="view-post"><?php echo Post::model()->adddotString($data->post_view);?></span><span class="pull-right"><?php echo Post::model()->checkTime($data->create_time); ?></span></p>            
        </div>
        <p><?php echo $data->content_1?></p>
    </div>
</div>
<?php } ?>
<?php  if (($tmp_i == $tmp_count) && ($tmp_i % 3 != 0)) {?>
</div>
<?php } ?>