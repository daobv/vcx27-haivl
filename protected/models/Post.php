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
class Post extends CActiveRecord {

    public $avatarUpload;
    const MODELPOST = 1;

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
        return 'post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menuId, name, content', 'required'),
            array('price, status, home,imgId, feature', 'numerical', 'integerOnly' => TRUE),
            array('name,alias,avatar,origin,warranty', 'length', 'max' => 255),
            array('content_1', 'length', 'max' => 500),
            array('rank', 'numerical', 'min' => 0, 'max' => 50, 'integerOnly' => TRUE),
            array('menuId', 'safe'),
            array('avatarUpload', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => TRUE),
            array('id, menuId, name, price, status, home, feature, rank', 'safe', 'on' => 'search'),
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
             'gallery' => array(self::BELONGS_TO, 'Gallery', 'imgId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'menuId' => 'Chuyên mục',
            'name' => 'Tên',
            'avatar' => 'Ảnh',
            'price' => 'Giá',
            'create_time' => 'Ngày tạo',
            'status' => 'Hiển thị',
            'home' => 'Khuyến mãi',
            'feature' => 'Bán chạy',
            'rank' => 'Thứ tự',
            'content_1' => 'Nội dung tóm tắt',
            'content' => 'Nội dung chi tiết',
            'origin' => 'Xuất xứ',
            'warranty' => 'Bảo hành'
        );
    }

    protected function beforeSave() {
        $this->create_time = time();
//        $this->avatarUpload = CUploadedFile::getInstance($this, 'avatar');
//        if (isset($this->avatarUpload)) {
//            $fileName = $this->avatarUpload->name;
//            $uploadFolder = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . date('Ymd');
//            if (!is_dir($uploadFolder)) {
//                mkdir($uploadFolder, 0755, TRUE);
//            }
//            $uploadFile = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
//            $this->avatarUpload->saveAs($uploadFile); //Upload file thong qua object CUploadedFile
//            $this->avatar = '/upload/' . date('Ymd') . '/' . $fileName; //Lưu path vào csdl
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
        $criteria->compare('menuId', $this->menuId);
        $criteria->compare('name', $this->name, TRUE);
        $criteria->compare('price', $this->price);
        $criteria->compare('status', $this->status);
        $criteria->compare('home', $this->home);
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

    function adddotString($strNum) {
 
        $len = strlen($strNum);
        $counter = 3;
        $result = "";
        while ($len - $counter >= 0)
        {
            $con = substr($strNum, $len - $counter , 3);
            $result = '.'.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        if(substr($result,0,1)=='.'){
            $result=substr($result,1,$len+1);   
        }
        return $result;
    }

    function checkTime($time) {
        $time_current = time();
        if ($time_current - $time > 1000) {
            return date("Y-m-d", $time);
        } else {
            return date("Y-m-d", $time);
        }  
    }

    function fbcommentcount($url) {
        $json = file_get_contents('https://graph.facebook.com/?ids=' . $url);
        return $json;
    }

}