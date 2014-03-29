<?php

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$topmem = $this->getTopmem();
$fanpage = $this->getFanPage();
$news = $this->getNews();

?>
<div id="top-mem" class="sidebar">
    <div class="wrapper-title">        
        <div class="title-content pull-right">TOP THÀNH VIÊN</div>
        <div class="title-left pull-right"></div>
    </div>
    <div class="box-content">
        <?php $key = 0; ?>
        <?php for ($i=count($topmem) - 1; $i >= 0; $i--) { 

            $tmp = $topmem[$i]['id'];
            if ($key < 10) {
                $key++;
                $tmp_new = UserMeta::model()->find("user_id = '$tmp'");
                $tmp_level = UserLevel::model()->findByPk($tmp_new->level_id);
        ?>
                <div class="mem-item pull-left">
                    <a href="#"><img class="pull-left" src="<?php echo $baseUrl . '/' . $tmp_new->avatar; ?>"></a>
                    <span class="mem-name bold pull-left"><?php echo $tmp_new->frist_name.' '.$tmp_new->last_name;?></span>
                    <span class="like-postsb">Like: <?php echo Post::model()->adddotString($tmp_new->post_like);?> | Lv: <?php echo $tmp_level->level;?> | Bài đăng: <?php echo $tmp_new->post?></span>
                </div>
        <?php
            } else {
                break;
            }
        } ?>

        
    </div>
</div>

<div id="fan-page" class="sidebar">
    <div class="wrapper-title">        
        <div class="title-content pull-right">FACEBOOK</div>
        <div class="title-left pull-right"></div>
    </div>
    <div class="box-content">
        <?php foreach ($fanpage as $value) {?>
            <div class="media pull-left">
                <?php echo html_entity_decode($value->content_1); ?>
            </div>
        <?php } ?>
    </div>
</div>

<div id="tin-tuc" class="sidebar">
    <div class="wrapper-title">
        <div class="title-content pull-right">TIN MỚI</div>
        <div class="title-left pull-right"></div>
    </div>

    <div class="box-content">
        <?php
        foreach ($news as $value) {


            if (!empty($value->avatar))
                $img = '<img src="' . $baseUrl . '/' . $value->avatar . '" alt="' . $value->name . '" title="' . $value->name . '">';
            else
                $img = '';
        ?>
            <div class="media pull-left">
                <a class="pull-left" href="<?php echo $baseUrl . '/bai-viet/' . $value->alias . '.html' ?>">
                    <?php echo $img ?>
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        <?php echo CHtml::link($value->name, array('bai-viet/' . $value->alias)); ?>
                    </h4>
                    <p><?php echo Post::model()->checkTime($value->create_time); ?></p>
                    <p><span class="like-postsb"><?php echo $value->post_like ?></span><span class="comment-postsb">86</span><span class="share-postsb">6</span></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>