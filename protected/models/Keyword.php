<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer    $id
 * @property integer    $parentId
 * @property string     $name
 * @property integer    $rank
 * @property integer    $status
 *
 * The followings are the available model relations:
 * @property Category   $parent
 * @property Category[] $categories
 * @property Product[]  $products
 */
class Keyword extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'keyword';
    }

    /**
     * @return array validation rules for model attributes.
     */
}