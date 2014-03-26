<?php

Yii::import('zii.widgets.CPortlet');

class MenuItem extends CPortlet {

    public function getMenuItem() {
		// return Menu::model()->findAll(array('order' => 'root,lft'));    
        $criteria = new CDbCriteria;
        $criteria->compare('level', 1);
        $criteria->order='rank ASC';
        return Menu::model()->findAll($criteria);
    }

    protected function renderContent() {
        $this->render('menuItem');
    }

}

?>