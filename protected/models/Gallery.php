<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer  $id
 * @property integer  $categoryId
 * @property string   $name
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
class Gallery extends CActiveRecord {

    public $avatarUpload;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'gallery';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('galleryId, name', 'required'),
            array('status, feature', 'numerical', 'integerOnly' => TRUE),
            array('name', 'length', 'max' => 255),
            array('rank', 'numerical', 'min' => 0, 'max' => 10, 'integerOnly' => TRUE),
            array('categoryId', 'safe'),
            array('avatarUpload', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => TRUE),
            array('id, galleryId, name, status, feature, rank', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'page' => array(self::HAS_MANY, 'Page', 'galleryId'),
            'post' => array(self::HAS_MANY, 'Post', 'imgId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Tên',
            'create_time' => 'Ngày tạo',
            'status' => 'Hiển thị',
            'feature' => 'Đặc biệt',
            'rank' => 'Thứ tự',
            'image' => 'Hình ảnh',
            'albumId' => 'Chọn album'
        );
    }

    protected function beforeSave() {
        $this->avatarUpload = CUploadedFile::getInstance($this, 'image');
        if (isset($this->avatarUpload)) {
            $fileName = $this->avatarUpload->name;
            $uploadFolder = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . date('Y-m-d');
            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder, 0755, TRUE);
            }
            $uploadFile = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
            $this->avatarUpload->saveAs($uploadFile); //Upload file thong qua object CUploadedFile
            $this->image = '/upload/' . date('Y-m-d') . '/' . $fileName; //Lưu path vào csdl
        }
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
        $criteria->compare('name', $this->name, TRUE);
        $criteria->compare('status', $this->status);
        $criteria->compare('feature', $this->feature);
        $criteria->compare('rank', $this->rank);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'rank DESC,id DESC'
                    ),
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                ));
    }

}