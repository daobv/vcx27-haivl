<?php

Yii::import('zii.widgets.CPortlet');

class AdsCenter extends CPortlet {

    public function getAdsCenter() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 121);
        return Page::model()->findAll($criteria);
    }
     

    protected function renderContent() {
        $this->render('adsCenter');
    }

}

?>