<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>

        <li class="file"><a href="<?php echo $baseUrl.'/'.$data->file?>"><?php echo $data->name ?></a></li>


