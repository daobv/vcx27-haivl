<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $name
 * @property string $description
 */
class Menu extends CActiveRecord {

    const ADMIN_TREE_CONTAINER_ID = 'menu_admin_tree';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE1: you should only define rules for those attributes that
        // will receive user inputs.
        // NOTE2: Remove ALL rules associated with the nested Behavior:
        // rgt,lft,root,level,id.
        return array(array('name', 'required'),
            array('name,alias', 'length', 'max' => 64), // The following rule is used by search().
            array('rank', 'numerical', 'min' => 0, 'max' => 20, 'integerOnly' => TRUE),
            // Please remove those attributes that should not be searched.
            array('name, description, alias', 'safe', 'on' => 'search'),);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('page' => array(self::HAS_MANY, 'Page', 'menuId'));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name' => 'Menu',
            'description' => 'Description',
        );
    }

    public function behaviors() {
        return array('NestedSetBehavior' => array('class' => 'ext.NestedSetBehavior', 'leftAttribute' => 'lft', 'rightAttribute' => 'rgt', 'levelAttribute' => 'level','hasManyRoots' => true));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    protected function afterDelete() {
        parent::afterDelete();
        // Remove related products
        $models = Products::model()->findAll('', array(':menu_id' => $this->id));
        foreach ($models as $model) {
            $model->delete();
        }
    }

}