<?php
class Controller extends CController {
    public $breadcrumbs=array();
    public $layout='//layouts/column2';
    
    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xF7F7F7
            ),
            'page' => array(
                'class' => 'CViewAction'
            )
        );
    }

}
