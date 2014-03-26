<?php

Yii::import('zii.widgets.CPortlet');

class ServicePage extends CPortlet {

    public function getService() {
        $criteria = new CDbCriteria;
        $criteria->compare('status', 1);
        $criteria->compare('feature',1);
        return Album::model()->findAll($criteria);
    }
     

    protected function renderContent() {
        $this->render('servicePage');
    }

}

?>
