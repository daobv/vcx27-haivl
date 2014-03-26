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
 * @property Product[]  $products
 */
class Document extends CActiveRecord {
    
    public $url_link;

    const PRICE = 1;
    const DOCUMENTSOFTWARE = 2;

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
        return 'document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('doc_name', 'required'),
            array('doc_name,url_link', 'length', 'max' => 255),
            array('status,doc_tab', 'numerical', 'integerOnly' => TRUE),
            array('doc_file', 'file', 'types' => 'jpg, gif, png, pdf, doc, docx, odt, txt, xlsx, xls, csv, zip, rar', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 50, 'tooLarge' => 'The file was larger than 50MB. Please upload a smaller file.'),
            array('doc_type, doc_size', 'length', 'max' => 250),
            array('create_time, doc_file', 'safe'),
            array('id, doc_name, doc_type, doc_size, up_dated, doc_file', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'doc_tab' => 'Chuyên mục',
            'doc_name' => 'Tên file',
            'doc_file' => 'Upload file (không quá 7MB)',
            'doc_size' => 'Kích thước file',
            'create_time' => 'Ngày cập nhật',
            'url_link' => 'Link phần mềm',
            'status'=>'Hiện thị'
        );
    }

    protected function beforeSave() {
        $this->create_time = time();
        return parent::beforeSave();
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('doc_tab', $this->doc_tab);
        $criteria->compare('doc_name', $this->doc_name, TRUE);
        $criteria->compare('doc_type', $this->doc_type);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'create_time DESC,id DESC'
                    ),
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
}