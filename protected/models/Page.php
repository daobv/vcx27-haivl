<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
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
class Page extends CActiveRecord {


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,content_1,categoryId', 'required'),
            array('status, home', 'numerical', 'integerOnly' => TRUE),
            array('title, alias,imgId,image,linkImg', 'length', 'max' => 255),
            array('content', 'length', 'max' => 500),
            array('rank', 'numerical', 'min' => 0, 'integerOnly' => TRUE),
            array('id, title, status, home, rank', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Category', 'categoryId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Tiêu đề',
            'create_time' => 'Ngày tạo',
            'status' => 'Hiển thị',
            'home' => 'Trang chủ',
            'rank' => 'Thứ tự',
            'images' => 'Hình ảnh',
            'content' => 'Nội dung tóm tắt',
            'content_1' => 'Nội dung',
            'alias' => 'Alias',
            'imgId' => 'Upload',
            'categoryId' => 'Chuyên mục'
        );
    }

    protected function beforeSave() {
//        $this->avatarUpload = CUploadedFile::getInstance($this, 'image');
//        if (isset($this->avatarUpload)) {
//            $fileName = $this->avatarUpload->name;
//            $uploadFolder = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . date('Y-m-d');
//            if (!is_dir($uploadFolder)) {
//                mkdir($uploadFolder, 0755, TRUE);
//            }
//            $uploadFile = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
//            $this->avatarUpload->saveAs($uploadFile); //Upload file thong qua object CUploadedFile
//            $this->image = '/upload/' . date('Y-m-d') . '/' . $fileName; //Lưu path vào csdl
//        }
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
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('status', $this->status);
        $criteria->compare('categoryId', $this->categoryId);
        $criteria->compare('rank', $this->rank);
        $criteria->order='id DESC';

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