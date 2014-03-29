<?php
$baseUrl = Yii::app()->request->baseUrl;

$cs = Yii::app()->getClientScript();

?>
<div id="content" class="pull-left">

    <div id="content-left" class="pull-left">
        <div class="wrapper-title">
            <div class="title-left pull-left"></div>
            <div class="title-content pull-left">ĐĂNG BÀI MỚI</div>
            <div class="title-right pull-left"></div>
        </div>
        
        <div id="wrapper-content-post" class="pull-left">

        </div>
        
    </div>

    <div id="content-right" class="pull-right">
        <?php $this->widget('RightUpload'); ?>
    </div>

</div>
