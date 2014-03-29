<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mạng xã hội hàng đầu Việt Nam</title>

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->

        <!--[if lt IE 9]>

              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

            <![endif]-->

        <!-- Le styles -->

        <?php
        $baseUrl = Yii::app()->request->baseUrl;
        $cs = Yii::app()->getClientScript();
        ?>

        <link href="<?php echo $baseUrl ?>/css/home/base.css" rel="stylesheet">
        <link href="<?php echo $baseUrl ?>/css/home/menu.css" rel="stylesheet">
        <link href="<?php echo $baseUrl ?>/css/home/jquery.mCustomScrollbar.css" rel="stylesheet">
        <link href="<?php echo $baseUrl ?>/css/home/media.css" rel="stylesheet">
        <link href="<?php echo $baseUrl ?>/css/home/dropdown.css" rel="stylesheet">

    </head>

    <body>

        <div class="page-header">
            <div class="container ">   
                <nav class="catmenu">
                    <?php $this->widget('MenuItem'); ?>
                </nav>             
                <?php if (Yii::app()->user->isGuest) { ?>
                    <a href="<?php echo Yii::app()->createUrl('site/loginfacebook'); ?>" class="account">Đăng nhập</a>
                <?php }?>
                <nav class="animenu">                    

                    <?php

                        $this->widget('zii.widgets.CMenu', array(

                            'encodeLabel' => false,

                            'items' => array(

                                array('label' => 'Đăng bài', 'url' => array('/dang-bai'), 'active' => Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'dang-bai', 'itemOptions'=>array('class'=>'dang-bai')),

                                array('label' => 'Chế ảnh', 'url' => array('/che-anh'), 'active' => Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'che-anh', 'itemOptions'=>array('class'=>'che-anh')),
                                
                            ),

                        ));

                    ?>
                   
                </nav>
                
            </div>

        </div>

        <div class="container container-mar">

            <div id="ads-top">

                <?php $this->widget('AdsTop'); ?>

            </div>

            <?php echo $content; ?>



        </div>

        <footer>

            <div class="container">

                <nav id="menu-footer">

                    <?php

                        $this->widget('zii.widgets.CMenu', array(

                            'encodeLabel' => false,

                            'items' => array(

                                array('label' => 'Liên hệ', 'url' => array('/lien-he'), 'active' => Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'lien-he', 'itemOptions'=>array('class'=>'lien-he')),

                                array('label' => 'Giới thiệu', 'url' => array('/gioi-thieu'), 'active' => Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'gioi-thieu'),

                                array('label' => 'FAQ', 'url' => array('/faq'), 'active' => Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'faq'),

                                array('label' => 'Điều khoản', 'url' => array('/dieu-khoan'), 'active' => Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'dieu-khoan', 'itemOptions'=>array('class'=>'dieu-khoan')),

                            ),

                        ));

                    ?>

                </nav> 



                <div id="copyright">

                    <?php $this->widget('Footer'); ?>

                </div>
            </div>
            <!--.footer-widgets--> 
        </div>
        <!--.container--> 
    </footer>
    <!-- Le javascript
        ================================================== --> 
    <!-- Placed at the end of the document so the pages load faster --> 
    <?php
    Yii::app()->getClientScript()->registerCoreScript('jquery', CClientScript::POS_END);
    $cs = Yii::app()->getClientScript();

    $cs->registerScriptFile($baseUrl . '/js/libs/jquery.masonry.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/dropdown.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/jquery.infinitescroll.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/jquery.mCustomScrollbar.concat.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/jquery.colorbox.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/dropdown.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/slides.min.jquery.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/js/jquery-scrolltofixed-min.js', CClientScript::POS_END);

    ?>
    <script>
        function connectFacebook() {
            FB.init({
                appId: '<?php echo ExtFacebook::APP_ID; ?>', // App ID
                status: true, // check login status
                cookie: true, // enable cookies to allow the server to access the session
                xfbml: true  // parse XFBML
            });

            FB.login(
                function (response) {
                    if (response.authResponse) {
                        var user_id;
                        var token;
                        token = response.authResponse.accessToken;
                        FB.api('/me', function (info) {
                            if (response.error) {
                                connectFacebookFail();
                            } else {
                                user_id = info.id;
                                $.ajax({
                                    url: '<?php echo Yii::app()->createUrl('site/login'); ?>',
                                    type: 'POST',
                                    data: {'user_id': user_id, 'access_token': token, 'network': 'facebook'},
                                    success: function (data) {
                                        window.location.reload();
                                    },
                                    error: function (data) {
                                        connectFacebookFail();
                                    }
                                });
                            }
                        });
                    } else {
                        connectFacebookFail();
                    }
                }, { scope: "email, publish_actions, user_location" });
        }

        function connectFacebookFail() {
            alert('Đăng nhập facebook thất bại!');
        }

        jQuery(function(){
            jQuery('#post').slides({
                preload: true,
                generateNextPrev: true
            });

            jQuery('#post1').slides({
                preload: true,
                generateNextPrev: true
            });

            jQuery('#post2').slides({
                preload: true,
                generateNextPrev: true
            });

            jQuery('#post3').slides({
                preload: true,
                generateNextPrev: true
            });

            jQuery(".like").click(function() {
                var id=$(this).parent().attr("id");

                var name=$(this).attr("name");
                var dataString = 'id='+ id + '&name='+ name;

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->createUrl('site/rate'); ?>",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        jQuery("#"+id).html(html);
                    } 
                });
            });

            jQuery(".load-more-post").click(function() {

                var name=$(this).attr("name");
                var dataString = 'offset='+ name;

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->createUrl('site/loadmore'); ?>",
                    data: dataString,
                    cache: false,
                    success: function(html) {
                        jQuery(".items").html(html);
                    } 
                });
            });

            var stickyNavTop = jQuery('#left-bar').offset().top;  
  
            var stickyNav = function(){  
                var scrollTop = jQuery(window).scrollTop();  
                       
                if (scrollTop > stickyNavTop) {   
                    jQuery('#left-bar').addClass('sticky');  
                } else {  
                    jQuery('#left-bar').removeClass('sticky');   
                }  
            };  
              
            stickyNav();  
              
            jQuery(window).scroll(function() {  
                stickyNav();  
            }); 

        });

    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>