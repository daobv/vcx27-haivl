<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>   
<div class="box">
    <a href="<?php echo $baseUrl . '/bai-viet/' . $data->alias . '.html' ?>">
        <img src="<?php echo $baseUrl . '/' . $data->avatar ?>" alt="<?php $data->name ?>" title="<?php $data->name ?>"/> 
    </a>
    <h5><?php echo CHtml::link($data->name, array('bai-viet/' . $data->alias), array('title' => $data->name)); ?></h5>
    <h5>Giá: <?php if ($data->price == 0) echo "Liên hệ"; else echo number_format($data->price, 0) . ' VNĐ' ?></h5>
</div>
