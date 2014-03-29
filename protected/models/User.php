<?php

class User extends CActiveRecord {
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
    // public $status;
    // public $registered;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email', 'required'),
            array('username, password, email', 'length', 'max' => 100),
            array('email','email'),
            array('status', 'in', 'range'=>array(0,1)),
        );
    }

    /**
     * @return array relational rules.
     */
   public function relations() {
       // NOTE: you may need to adjust the relation name and the related
       // class name for the relations automatically generated below.
       return array(
           'user_meta' => array(self::HAS_ONE, 'UserMeta', 'user_id'),
           'user_group' => array(self::BELONGS_TO, 'UserGroup', 'group_id'),
       );
   }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
            'email' => 'Email',
        );
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return $this->hashPassword($password) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password) {
        return md5($password);
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    // protected function generateSalt() {
    //     return uniqid('', true);
    // }
    
    // public function beforeSave() {
    //     if (parent::beforeSave()) {
    //         $this->password = User::hashPassword($this->password,'');
    //         return TRUE;
    //     } else
    //         return FALSE;
    // }
}