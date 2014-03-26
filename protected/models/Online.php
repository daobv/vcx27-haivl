<?php


class Online extends CActiveRecord {

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
        return 'online';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,nick,phone', 'required'),
            array('status', 'numerical', 'integerOnly' => TRUE),
            array('id, name, nick, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
         return array(
//                'parent'     => array(self::BELONGS_TO, 'Category', 'parentId'),
//                'categories' => array(self::HAS_MANY, 'Category', 'parentId', 'order' => 'rank DESC', 'condition' => 'status=1'),
//                'page' => array(self::HAS_MANY, 'Page', 'categoryId'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Tên',
            'nick' => 'Nick',
            'status' => 'Hiển thị',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name);
        $criteria->compare('nick', $this->nick);
        $criteria->compare('phone', $this->phone);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => FALSE,
                    'sort' => array(
                        'defaultOrder' => 'id DESC'
                    ),
                ));
    }

}