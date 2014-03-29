<?php

Yii::import('zii.widgets.CPortlet');

class RightUpload extends CPortlet {

    public function getGioiHan() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 127);
        return Page::model()->findAll($criteria);
    }

    public function getNoiQuy() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 128);
        return Page::model()->findAll($criteria);
    }
    
    protected function renderContent() {
        $this->render('rightUpload');
    }

}

?>
