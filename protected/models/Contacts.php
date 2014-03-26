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
class Contacts extends CActiveRecord {

    public $uploadImg;
    const MODELPRODUCT = 1;

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
        return 'contacts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('categoryId, company_name, services_offered', 'required'),
//            array('price, status, home, feature', 'numerical', 'integerOnly' => TRUE),
            array('name,alias', 'length', 'max' => 255),
            array('categoryId', 'safe'),
            array('uploadImg', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => TRUE),
            array('id, categoryId,status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menu' => array(self::BELONGS_TO, 'Menu', 'menuId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'categoryId' => 'Chuyên mục',
            'company_name' => 'Tên',
            'image' => 'Ảnh',
        );
    }

    protected function beforeSave() {
        $this->create_time = time();
        $this->uploadImg = CUploadedFile::getInstance($this, 'image');
        if (isset($this->uploadImg)) {
            $fileName = $this->uploadImg->name;
            $uploadFolder = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . time();
            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder, 0755, TRUE);
            }
            $uploadFile = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
            $this->uploadImg->saveAs($uploadFile); //Upload file thong qua object CUploadedFile
            $this->image = '/upload/' . time() . '/' . $fileName; //Lưu path vào csdl
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
        $criteria->compare('categoryId', $this->categoryId);
        $criteria->compare('company_name', $this->company_name, TRUE);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'rank DESC,id DESC'
                    ),
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }

}