<?php
$baseUrl = Yii::app()->request->baseUrl;

$cs = Yii::app()->getClientScript();

?>
<div id="content" class="pull-left">

    <div id="content-left" class="pull-left">
        <div class="wrapper-title">
            <div class="title-left pull-left"></div>
            <div class="title-content pull-left">GIỚI THIỆU</div>
            <div class="title-right pull-left"></div>
        </div>
        
        <div id="wrapper-content-post" class="pull-left">
            <?php 
                $criteria = new CDbCriteria;
                $criteria->compare('categoryId', 115);
                $tmp_contact = Page::model()->findAll($criteria);
                foreach ($tmp_contact as $key => $value) {
                    echo html_entity_decode($value->content_1);
                }
                
            ?>
        </div>
        
    </div>

    <div id="content-right" class="pull-right">
        <?php $this->widget('Right'); ?>
    </div>

</div>