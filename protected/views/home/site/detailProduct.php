<?php
$baseUrl = Yii::app()->request->baseUrl;

$cs = Yii::app()->getClientScript();

?>
<div id="content" class="pull-left">

    <div id="content-left" class="pull-left">
        <div class="wrapper-title">
            <div class="title-left pull-left"></div>
            <div class="title-content pull-left">
                <?php
                $menu = Menu::model()->findByAttributes(array('id' => $model->menuId));

                if ($menu->root == $menu->id) {
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=> array(
                            $menu->name => array('danh-muc/'.$menu->alias),
                        ),
                        'separator' => '&nbsp;&nbsp;>&nbsp;&nbsp;',
                    )); 
                } else {
                    $menu_root_name = Menu::model()->findByAttributes(array('id' => $menu->root));

                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=> array(
                            $menu_root_name->name => array('danh-muc/'.$menu_root_name->alias),
                            $menu->name => array('danh-muc/'.$menu->alias),

                        ),
                        'separator' => '&nbsp;&nbsp;>&nbsp;&nbsp;',
                    ));    
                }
                ?>
            </div>
            <div class="title-right pull-left"></div>
        </div>
        
        <div id="wrapper-content-post" class="pull-left">
            <h3 class="title"><?php echo $model->name ?></h3>

            <div class="attri-post">
                <div class="attri-post-left pull-left">
                    <p class="nguon"><strong>Nguồn: </strong>Youtube</p>

                    <p class="chuyen-muc"><strong>Chuyên mục: </strong> <?php echo $menu->name ?></p>

                    <p class="binh-luan"><strong>Lượt bình luận: </strong>10</p>
                </div>
                <div class="attri-post-right pull-right">
                    <p><span class="bold">Đăng bởi: </span><a href="#">Phạm Hiển</a></p>
                    <div class="info-post-right">
                        <div class="avatar-author pull-left"><img src="<?php echo $baseUrl . '/' . 'images/home/avatar-default.jpg' ?>"></div>
                        <div class="time-like pull-left">
                            <p class="time-add">10 tiếng trước</p>
                            <p class="like-total">3.750</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="like-post">
                <div class="pull-left face-like">
                    <span class="bold">Thích điều này?</span>
                    <div class="fb-like" data-href="<?php echo $baseUrl . '/san-pham/' . $model->alias . '.html' ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                </div>
                <div class="pull-right">
                    <span class="like-sys pull-left bold">100</span><span class="dislike-sys pull-right bold">100</span>
                </div>
            </div>
            <div class="details-post">
                <img src="<?php echo $baseUrl . '/' . $model->avatar ?>">
                <br/>
                <?php echo $model->content ?>
            </div>
            <div class="like-fanpage">
                <p class="bold">Like O2 để được biết nhiều hơn</p>
                <div class="fb-like-box" data-href="https://www.facebook.com/NavaGroup" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
            </div>
            <div class="comment-post">
                <div class="fb-comments" data-href="http://example.com/comments" data-width="635" data-numposts="5" data-colorscheme="light"></div>
            </div>
        </div>
        
    </div>

    <div id="content-right" class="pull-right">
        <?php $this->widget('Right'); ?>
    </div>

</div>
