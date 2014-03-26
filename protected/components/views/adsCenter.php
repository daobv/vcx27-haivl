<?php
$baseUrl = Yii::app()->request->baseUrl;
$lr = $this->getAdsCenter();
foreach ($lr as $value) {
    if ($value->rank == 1) 
        $class = 'pull-left ads-center-left';
    else 
        $class = 'pull-right ads-center-right';

    if (!empty($value->image))
        $img = $baseUrl.'/'.$value->image;
    else 
        $img = $value->linkImg;
    ?> 
    <div class="<?php echo $class ?>">
        <a href="<?php echo $baseUrl.'/quang-cao/'.$value->alias.'.html'?>"><img src="<?php echo $img ?>"></a>
    </div>
<?php
}?>
