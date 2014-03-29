<?php

Yii::import('zii.widgets.CPortlet');

class Header extends CPortlet {

    public function getHeader() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 113);
        return Page::model()->findAll($criteria);
    }
     

    protected function renderContent() {
        $this->render('header');
    }

}

?>
