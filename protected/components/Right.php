<?php
Yii::import('zii.widgets.CPortlet');

class Right extends CPortlet {
    
    public function getFanPage() {
        $criteria = new CDbCriteria;
        $criteria->compare('categoryId', 122);
        return Page::model()->findAll($criteria);
    }

    public function getNews() {
        $criteria = new CDbCriteria;
        $criteria->compare('status', 1);
        $criteria->limit = 5;
        $criteria->order = 'id DESC';
        return Product::model()->findAll($criteria);
    }

    protected function renderContent() {
        $this->render('right');
    }
}
?>
