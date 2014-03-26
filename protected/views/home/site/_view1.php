<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>   
<div class="box-post pull-left">
    <div class="content-post pull-left">
        <a href="<?php echo $baseUrl . '/san-pham/' . $data->alias . '.html' ?>">
            <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
        </a>
        <p><?php echo $data->content;?></p>
    </div>
    <div class="meta-post  pull-right">
        <h3><?php echo CHtml::link($data->name, array('san-pham/' . $data->alias), array('title' => $data->name)); ?></h3>
        <p>Đăng bởi: <a href="#">Phạm Hiển</a> - 10 giờ trước</p>
        <p><span class="view-post">2.634</span><span class="comment-post">1.254</span><span class="like-total">4.265</span></p>
        <p class="pull-left"><span class="like-sys pull-left bold">100</span><span class="dislike-sys pull-right bold">100</span></p>
    </div> 
</div>
