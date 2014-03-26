<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$gioihan = $this->getGioiHan();
$noiquy = $this->getNoiQuy();
?>
<div id="gioi-han" class="sidebar">
    <div class="box-content">
        <?php foreach ($gioihan as $value) {?>
            <div class="media pull-left">
                <?php 

                echo html_entity_decode($value->content_1); ?>
            </div>
        <?php } ?>
    </div>
</div>

<div id="noi-quy" class="sidebar">
    <div class="box-content">
        <?php foreach ($noiquy as $value) {?>
            <div class="media pull-left">
                <?php 
                echo html_entity_decode($value->content_1); ?>
            </div>
        <?php } ?>
    </div>
</div>
