<?php

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$fanpage = $this->getFanPage();
$news = $this->getNews();

?>
<div id="top-mem" class="sidebar">
    <div class="wrapper-title">        
        <div class="title-content pull-right">TOP THÀNH VIÊN</div>
        <div class="title-left pull-right"></div>
    </div>
    <div class="box-content">
        <div class="mem-item pull-left">
            <div class="item-left pull-left">
                <a href="#"><img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem1.jpg' ?>"></a>
                <span class="mem-name bold pull-left">Gió Wi...</span>
                <span class="like-postsb">567</span>
            </div>
            <div class="item-right pull-right">
                <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem2.jpg' ?>">
                <span class="mem-name bold pull-left">Pham H...</span>
                <span class="like-postsb bold">567</span>
            </div>
        </div>
        <div class="mem-item pull-left">
            <div class="item-left pull-left">
                <a href="#"><img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem3.jpg' ?>"></a>
                <span class="mem-name bold pull-left">Gió Wi...</span>
                <span class="like-postsb">567</span>
            </div>
            <div class="item-right pull-right">
                <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem4.jpg' ?>">
                <span class="mem-name bold pull-left">Pham H...</span>
                <span class="like-postsb bold">567</span>
            </div>
        </div>
        <div class="mem-item pull-left">
            <div class="item-left pull-left">
                <a href="#"><img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem1.jpg' ?>"></a>
                <span class="mem-name bold pull-left">Gió Wi...</span>
                <span class="like-postsb">567</span>
            </div>
            <div class="item-right pull-right">
                <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem2.jpg' ?>">
                <span class="mem-name bold pull-left">Pham H...</span>
                <span class="like-postsb bold">567</span>
            </div>
        </div>
        <div class="mem-item pull-left">
            <div class="item-left pull-left">
                <a href="#"><img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem3.jpg' ?>"></a>
                <span class="mem-name bold pull-left">Gió Wi...</span>
                <span class="like-postsb">567</span>
            </div>
            <div class="item-right pull-right">
                <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem4.jpg' ?>">
                <span class="mem-name bold pull-left">Pham H...</span>
                <span class="like-postsb bold">567</span>
            </div>
        </div>
        <div class="mem-item pull-left">
            <div class="item-left pull-left">
                <a href="#"><img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem3.jpg' ?>"></a>
                <span class="mem-name bold pull-left">Gió Wi...</span>
                <span class="like-postsb">567</span>
            </div>
            <div class="item-right pull-right">
                <img class="pull-left" src="<?php echo $baseUrl . '/' . 'images/home/mem4.jpg' ?>">
                <span class="mem-name bold pull-left">Pham H...</span>
                <span class="like-postsb bold">567</span>
            </div>
        </div>
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
        ?>
            <div class="media pull-left">
                <a class="pull-left" href="<?php echo $baseUrl . '/san-pham/' . $value->alias . '.html' ?>">
                    <?php echo $img ?>
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        <?php echo CHtml::link($value->name, array('san-pham/' . $value->alias)); ?>
                    </h4>
                    <p>13/03/2014 : 20:00</p>
                    <p><span class="like-postsb">567</span><span class="comment-postsb">86</span><span class="share-postsb">6</span></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>