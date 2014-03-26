<?php

$baseUrl = Yii::app()->request->baseUrl;

$menu = $this->getMenuItem();



$arr[0] = array(

    'label' => '',

    'url' => '/vcx27-haivl',

);



if (!empty($menu)) {

    foreach ($menu as $key => $value) {

        $url = array('danh-muc/' .$value->alias);

        if ($value->level == 1) {

            $arr[$key+1] = array(

                'label' => $value->name,

                'url' => $url,

            );

        }

        

    }

}

$this->widget('zii.widgets.CMenu', array(

    'encodeLabel' => false,

    'firstItemCssClass'=>'first-item',

    'activeCssClass'=>'current',

    'items' => $arr,

    'htmlOptions' => array('class' => 'navmenu'),

));

?>