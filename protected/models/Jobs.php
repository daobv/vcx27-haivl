<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer  $id
 * @property integer  $categoryId
 * @property string   $location
 * @property string   $avatar
 * @property integer  $price
 * @property string   $dateCreated
 * @property string   $avatarUpload
 * @property integer  $status
 * @property integer  $home
 * @property integer  $feature
 * @property integer  $rank
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class Jobs extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    const JOB_UNIVERSITY =1;
    const JOB_COLLEGE = 2;
    const JOB_INTERMEDIATE =3;
    const JOB_GENERAL = 4;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'jobs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('location,content,userId,categoryId,gender', 'required'),
            array('status, number', 'numerical', 'integerOnly' => TRUE),
            array('location, alias,education,wage, create_time, update_time ', 'length', 'max' => 255),
            array('id, name, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'categoryId' => 'Danh mục',
            'location' => 'Vị trí',
            'number' => 'Số lượng tuyển',
            'status' => 'Hiển thị',
            'gender' => 'Giới tính',
            'working_hours' => 'Hình thức làm việc',
            'content' => 'Nội dung',
            'content' => 'Nội dung tóm tắt',
            'alias' => 'Alias',
            'skills' => 'Kỹ năng',
            'education' => 'Trình độ',
            'wage' => 'Mức lương',
            'job_type' => 'Hình thức làm việc',
            'probation_period' => 'Thời gian thử việc',
            'mode' => 'Chế độ khác',
            'required' => 'Yêu cầu hồ sơ',
            'create_time' => 'Ngày đăng',
            'update_time' => 'Ngày hết hạn',
        );
    }

    protected function beforeSave() {
        return parent::beforeSave();
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
        $criteria->compare('location', $this->location, TRUE);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'id DESC'
                    ),
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                ));
    }

}