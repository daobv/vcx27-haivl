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
     * @property Post[]  $posts
     */
    class Category extends CActiveRecord
    {
        /**
         * Returns the static model of the specified AR class.
         * @param string $className active record class name.
         * @return Category the static model class
         */
        public static function model($className = __CLASS__)
        {
            return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
            return 'category';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('name', 'required'),
                array('rank', 'numerical', 'min' => 0, 'max' => 100, 'integerOnly' => TRUE),
                array('name', 'length', 'max' => 255),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('parentId', 'safe'),
                array('id, parentId, name, rank, status', 'safe', 'on' => 'search'),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'parent'     => array(self::BELONGS_TO, 'Category', 'parentId'),
                'categories' => array(self::HAS_MANY, 'Category', 'parentId', 'order' => 'rank DESC', 'condition' => 'status=1'),
                'page' => array(self::HAS_MANY, 'Page', 'categoryId'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id'       => 'ID',
                'parentId' => 'Chuyên mục cha',
                'name'     => 'Tên',
                'rank'     => 'Thứ tự',
                'status'   => 'Hiển thị',
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search()
        {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare('id', $this->id);
            $criteria->compare('parentId', $this->parentId);
            $criteria->compare('name', $this->name, TRUE);
            $criteria->compare('rank', $this->rank);
            $criteria->compare('status', $this->status);

            return new CActiveDataProvider($this, array(
                'criteria'   => $criteria,
                'pagination' => FALSE,
                'sort'       => array(
                    'defaultOrder' => 'parentId ASC,rank DESC'
                ),
            ));
        }
    }