<?php

Yii::import('zii.widgets.CPortlet');

class Footer extends CPortlet {

    public function getFooter() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 114);
        return Page::model()->findAll($criteria);
    }
    
    protected function renderContent() {
        $this->render('footer');
    }

}

?>

