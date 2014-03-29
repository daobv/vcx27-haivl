<?php

$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

$tmp_new = UserMeta::model()->find("user_id = '$model->user_id'");
$tmp_level = UserLevel::model()->findByPk($tmp_new->level_id);
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
                            $menu->name => array('kenh/'.$menu->alias),
                        ),
                        'separator' => '&nbsp;&nbsp;>&nbsp;&nbsp;',
                    )); 
                } else {
                    $menu_root_name = Menu::model()->findByAttributes(array('id' => $menu->root));
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=> array(
                            $menu_root_name->name => array('kenh/'.$menu_root_name->alias),
                            $menu->name => array('kenh/'.$menu->alias),
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
                    <p class="nguon"><strong>Nguồn: </strong><?php echo $model->origin ?></p>
                    <p class="chuyen-muc"><strong>Chuyên mục: </strong> <?php echo $menu->name ?></p>
                    <p class="binh-luan"><strong>Lượt bình luận: </strong>10</p>
                </div>

                <div class="attri-post-right pull-right">
                    <p><span class="bold">Đăng bởi: </span><a href="#"><?php echo $tmp_new->frist_name.' '.$tmp_new->last_name; ?></a></p>
                    <div class="info-post-right">
                        <div class="avatar-author pull-left"><img src="<?php echo $baseUrl . '/' . $tmp_new->avatar; ?>"></div>
                        <div class="time-like pull-left">
                            <p class="time-add"><?php echo Post::model()->checkTime($model->create_time); ?></p>
                            <p>Like: <?php echo Post::model()->adddotString($tmp_new->post_like);?> | Lv: <?php echo $tmp_level->level;?></p>
                        </div>

                    </div>

                </div>

            </div>

            <div class="like-post">

                <div class="pull-left face-like">

                    <span class="bold">Thích điều này?</span>

                    <div class="fb-like" data-href="<?php echo $baseUrl . '/bai-viet/' . $model->alias . '.html' ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>

                </div>

                <div class="pull-right">

                    <div id="<?php echo $model->id; ?>" class="pull-right">
                        <span class="like like-sys pull-left bold" name="up"><?php echo $model->post_like; ?></span>
                        <span class="like dislike-sys pull-right bold" name="down"><?php echo $model->post_dislike; ?></span>
                    </div>

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

