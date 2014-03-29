<?php

class UserGroup extends CActiveRecord {
    /**
     * The followings are the available columns in table 'tbl_user':
     * @var integer $id
     * @var string $username
     * @var string $password
     * @var string $salt
     * @var string $email
     * @var string $profile
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    // public $username;
    // public $password;
    // public $email;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 20),
        );
    }

    /**
     * @return array relational rules.
     */
   public function relations() {
       // NOTE: you may need to adjust the relation name and the related
       // class name for the relations automatically generated below.
       return array(
           'user' => array(self::HAS_MANY, 'User', 'id'),
       );
   }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name' => 'Nhóm',
        );
    }

    
}