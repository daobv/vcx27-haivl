<?php
$serAll = $this->getService();
?>
        <?php
        foreach ($serAll as $k => $item) {
            if ($k % 3 == 0)
                $class = 'margless';
            else
                $class = '';
            ?>
            <div class="span4 <?php echo $class; ?>" style="margin-bottom:20px; position: relative">
                <a href="<?php echo Yii::app()->request->baseUrl.'/hinh-anh/'.$item->id.'-'.$item->alias.'.html' ?>"><img  src="<?php echo Yii::app()->request->baseUrl . '/' . $item->image ?>" style="height:180px"></a>
                <div class="title" style=" position: absolute; bottom: 0; left: 0; color: #fff; text-align: right; width: 92.8%; opacity: 0.5; padding: 3.5%; background-color: #000"><?php echo $item->name ?></div>
            </div>
        <?php } ?>
