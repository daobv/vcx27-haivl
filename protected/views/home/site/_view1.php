<?php

$baseUrl = Yii::app()->request->baseUrl;

$cs = Yii::app()->getClientScript();

$tmp_count = count($dataProvider->getData());

$tmp_new = User::model()->find("id = '$data->user_id'");

?>   

<div class="box-post pull-left <?php if (($index + 1) == $tmp_count) echo 'lastItem';?>">
    <div class="content-post pull-left">
        <a href="<?php echo $baseUrl . '/bai-viet/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <p><?php echo $data->content;?></p>
    </div>

    <div class="meta-post  pull-right">
        <h3><?php echo CHtml::link($data->name, array('bai-viet/' . $data->alias), array('title' => $data->name)); ?></h3>
        <p>Đăng bởi: <a href="#"><?php echo $tmp_new->username; ?></a> - <?php echo Post::model()->checkTime($data->create_time); ?></p>
        <p><span class="view-post"><?php echo Post::model()->adddotString($data->post_view);?></span><span class="comment-post">1.254</span><!-- <span class="like-total"><?php //echo Post::model()->adddotString(//$data->like_post);?></span> --></p>
        <div id="<?php echo $data->id; ?>" class="pull-left">
            <span class="like like-sys pull-left bold" name="up"><?php echo $data->post_like; ?></span>
            <span class="like dislike-sys pull-right bold" name="down"><?php echo $data->post_dislike; ?></span>
        </div>
    </div> 

</div>

