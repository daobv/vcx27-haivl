<?php
$serAll = $this->getService();
?>
<div class="row-cucna1">
    <div class="services">
        <h3>SẢN PHẨM TIÊU BIỂU</h3>
        <?php
        foreach ($serAll as $k => $item) {
            if ($k == 0)
                $class = 'margless';
            else
                $class = '';
            ?>
            <div class="span4 <?php echo $class; ?>">
                <a href="<?php echo Yii::app()->request->baseUrl.'/hinh-anh/'.$item->id.'-'.$item->alias.'.html' ?>"><img  src="<?php echo Yii::app()->request->baseUrl . '/' . $item->image ?>"></a>
                <div class="title"><?php echo $item->name ?></div>
                <?php echo CHtml::link('> XEM ẢNH', array('hinh-anh/' . $item->id . '-' . $item->alias)); ?>
            </div>
        <?php } ?>
    </div>
</div>