<?php

class SiteController extends HomeController {

    public function actionIndex() {
        //Home page
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 and menuId=35';
        $criteria->order = 'create_time DESC';
        $criteria->limit = 9;
        $dataProvider = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria,
                ));
        
        $criteria2 = new CDbCriteria();
        $criteria2->condition = 'status=1 and menuId=36';
        $criteria2->order = 'create_time DESC';
        $criteria2->limit = 9;
        $dataProvider1 = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria2,
                ));

        $criteria3 = new CDbCriteria();
        $criteria3->condition = 'status=1 and menuId=37';
        $criteria3->order = 'create_time DESC';
        $criteria3->limit = 9;
        $dataProvider2 = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria3,
                ));

        $criteria4 = new CDbCriteria();
        $criteria4->condition = 'status=1 and menuId=39';
        $criteria4->order = 'create_time DESC';
        $criteria4->limit = 9;
        $dataProvider3 = new CActiveDataProvider('Product', array(
                    'criteria' => $criteria4,
                ));

        $this->render('home', array('dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1, 'dataProvider2' => $dataProvider2, 'dataProvider3' => $dataProvider3));
    }

    public function actionCategory() {
        $menu = Menu::model()->findByAttributes(array('alias' => $_GET['alias']));
        $criteria = new CDbCriteria;
        $criteria->compare('root', $menu->id);
        $criteria->compare('level', 2);
        $sub = Menu::model()->findAll($criteria);        
        
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 AND menuId=' . $menu->id;
        $criteria->order = 'create_time DESC';

        $dataProvider = new CActiveDataProvider('Product', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));

        $this->render('category', array(
            'dataProvider' => $dataProvider,
            'menu' => $menu,
            'sub' => $sub,
        ));
    }

    

    public function actionLogin() {

        if (isset($_POST['user_id']) && isset($_POST['access_token'])) {
            $userId = $_POST['user_id'];
            $accessToken = $_POST['access_token'];

            if (isset($_POST['network']) && $_POST['network'] == 'facebook') {
                /* @var ExtFacebook $facebook */
                $facebook = new ExtFacebook();
                $facebook->setAccessToken($accessToken);

                // Login with facebook
                if (!$facebook->loginFacebook()) {
                    throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));
                } else {
                    /** @var Users $user */
                    $user = Users::model()->find("user_social_id = '$userId'");
                    if ($user != null) {
                        $data = CJSON::encode(array(
                            'user_name' => $user->user_social_username,
                            'user_gender' => $user->user_gender,
                        ));
                        echo '<pre>';
                        print_r($data);
                        echo '</pre>';
                        exit();
                        // $result = file_get_contents("http://lorge.info/xenforo/api/MarketSignUp.php?e=$user->user_email&p=$user->user_social_username&k=".ConstantsUtils::API_KEY."&t=".time()."&d=$data");
                    }
                }
            } else {
                throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));
            }
        } else {
            $this->render('login');
        }

    }

    public function actionSolution() {
        $category = Category::model()->findByAttributes(array('alias' => 'giai-phap'));
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 AND categoryId=' . $category->id;
        $criteria->order = 'create_time DESC';
        $dataProvider = new CActiveDataProvider('Page', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('solution', array(
            'dataProvider' => $dataProvider,
            'category' => $category->name
        ));
    }

    public function actionNews() {
        $category = Category::model()->findByAttributes(array('alias' => 'tin-tuc'));
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 AND categoryId=' . $category->id;
        $criteria->order = 'create_time DESC';
        $dataProvider = new CActiveDataProvider('Page', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('solution', array(
            'dataProvider' => $dataProvider,
            'category' => $category->name
        ));
    }

    public function actionQuote() {
        $criteria = new CDbCriteria();
        $criteria->condition = 'fileId=' . File::QUOTE;
        $dataProvider = new CActiveDataProvider('File', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('file', array(
            'dataProvider' => $dataProvider,
            'fileId' => 'Báo giá',
        ));
    }

    public function actionDocument() {
        $criteria = new CDbCriteria();
        $criteria->condition = 'fileId=' . File::DS;
        $dataProvider = new CActiveDataProvider('File', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('file', array(
            'dataProvider' => $dataProvider,
            'fileId' => 'Tài liệu - Phần mềm',
        ));
    }

    public function actionPage() {
        $category = Category::model()->findByAttributes(array('alias' => $_GET['alias']));
        if ($category->alias == 'gioi-thieu') {
            $about = Page::model()->findByAttributes(array('categoryId' => $category->id));
            $this->render('category', array(
                'model' => $about
            ));
        } elseif ($category->alias == 'giai-phap' or $category->alias == 'tin-tuc') {
            $criteria = new CDbCriteria();
            $criteria->condition = 'status=1 AND categoryId=' . $category->id;
            $criteria->order = 'create_time DESC';
            $dataProvider = new CActiveDataProvider('Page', array(
                        'pagination' => array(
                            'pageSize' => Yii::app()->params['postsPerPage'],
                        ),
                        'criteria' => $criteria,
                    ));
            $this->render('page', array(
                'name' => $category->name,
                'dataProvider' => $dataProvider,
            ));
        }
    }

    public function actionDetail() {
        $model = Page::model()->findByAttributes(array('alias' => $_GET['alias']));

        $this->render('_detail', array(
            'model' => $model,
        ));
    }

    public function actionDetailProduct() {
        $model = Product::model()->findByAttributes(array('alias' => $_GET['alias']));
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 AND menuId=' . $model->menuId . ' AND id <>'.$model->id;
        $criteria->order = 'create_time DESC';
        $dataProvider = new CActiveDataProvider('Product', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('detailProduct', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAbout() {
        $this->render('about');
    }
    public function actionContact() {        
        $this->render('contact');
    }
    public function actionFaq() {
        $this->render('faq');
    }
    public function actionDieukhoan() {        
        $this->render('dieukhoan');
    }
    public function actionUpload() {        
        $this->render('upload');
    }
}

