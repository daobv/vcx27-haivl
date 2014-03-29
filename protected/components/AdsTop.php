<?php

Yii::import('zii.widgets.CPortlet');

class AdsTop extends CPortlet {

    public function getAdsTop() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 120);
        return Page::model()->findAll($criteria);
    }
     
    protected function renderContent() {
        $this->render('adsTop');
    }

}

?>