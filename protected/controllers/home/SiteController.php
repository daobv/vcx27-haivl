<?php

class SiteController extends HomeController {

    public function actionIndex() {
        //Home page
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 and menuId=35';
        $criteria->order = 'create_time DESC';
        $criteria->limit = 9;
        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination'=>false,
                    'criteria' => $criteria,
                ));
        
        $criteria2 = new CDbCriteria();
        $criteria2->condition = 'status=1 and menuId=36';
        $criteria2->order = 'create_time DESC';
        $criteria2->limit = 9;
        $dataProvider1 = new CActiveDataProvider('Post', array(
                    'pagination'=>false,
                    'criteria' => $criteria2,
                ));

        $criteria3 = new CDbCriteria();
        $criteria3->condition = 'status=1 and menuId=37';
        $criteria3->order = 'create_time DESC';
        $criteria3->limit = 9;
        $dataProvider2 = new CActiveDataProvider('Post', array(
                    'pagination'=>false,
                    'criteria' => $criteria3,
                ));

        $criteria4 = new CDbCriteria();
        $criteria4->condition = 'status=1 and menuId=39';
        $criteria4->order = 'create_time DESC';
        $criteria4->limit = 9;
        $dataProvider3 = new CActiveDataProvider('Post', array(
                    'pagination'=>false,
                    'criteria' => $criteria4,
                ));

        $this->render('home', array('dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1, 'dataProvider2' => $dataProvider2, 'dataProvider3' => $dataProvider3));
    }

    public function actionCategory() {
        $menu = Menu::model()->findByAttributes(array('alias' => $_GET['alias']));
        $tmp_menuid = $menu->attributes['id'];
        $criteria = new CDbCriteria;
        $criteria->compare('root', $menu->id);
        $criteria->compare('level', 2);
        $sub = Menu::model()->findAll($criteria);        
        
        $criteria1 = new CDbCriteria();
        $criteria1->condition = 'status=1 AND menuId=' . $tmp_menuid;

        $criteria1->offset = 0;
        $criteria1->limit = 5;

        $criteria1->order = 'create_time DESC';
        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination'=>false,
                    'criteria' => $criteria1,
                ));



        $this->render('category', array(
            'dataProvider' => $dataProvider,
            'menu' => $menu,
            'sub' => $sub,
        ));
    }

    public function actionLoadMore() {
        // $menu = Menu::model()->findByAttributes(array('alias' => $_GET['alias']));
        // $tmp_menuid = $menu->attributes['id'];
        
        // $criteria = new CDbCriteria();
        // $criteria->condition = 'status=1 AND menuId=' . $tmp_menuid;

        // $criteria->offset = 0;
        // $criteria->limit = 5;

        // $criteria->order = 'create_time DESC';

        // $dataProvider = new CActiveDataProvider('Post', array(
        //             'pagination'=>false,
        //             'criteria' => $criteria,
        //         ));

        echo 'âssa';

        // $this->render('category', array(
        //     'dataProvider' => $dataProvider,
        //     'menu' => $menu,
        //     'sub' => $sub,
        // ));
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
                    $user = User::model()->find("social_id = '$userId'");
                    if ($user != null) {
                        $data = CJSON::encode(array(
                            'username' => $user->social_username,
                            'gender' => $user->gender,
                        ));
                    }
                }
            } else {
                throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));
            }
        } else {
            throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));
        }

    }

    public function actionRate() {
        if(isset($_POST['id']) && isset($_POST['name'])) {
            $tmp_id = $_POST['id'];
            $tmp_action = $_POST['name'];

            // $criteria = new CDbCriteria;
            // $criteria->compare('id', $tmp_id);
            $tmp_info = Post::model()->find("id = '$tmp_id'");

            if ($tmp_action == 'up') {
                $tmp_like = $tmp_info->post_like + 1;
                $tmp_dislike = $tmp_info->post_dislike;

            } else {
                $tmp_like = $tmp_info->post_like;
                $tmp_dislike = $tmp_info->post_dislike + 1;

            }

            $tmp_info->post_like = $tmp_like;
            $tmp_info->post_dislike = $tmp_dislike;
            $tmp_info->save();

            echo '<span id="'.$tmp_id.'" class="like like-sys pull-left bold" name="up">'.$tmp_like.'</span><span id="'.$tmp_id.'" class="like dislike-sys pull-right bold" name="down">'.$tmp_dislike.'</span>';
            
        }
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

    public function actionDetailPost() {
        $model = Post::model()->findByAttributes(array('alias' => $_GET['alias']));
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=1 AND menuId=' . $model->menuId . ' AND id <>'.$model->id;
        $criteria->order = 'create_time DESC';
        $dataProvider = new CActiveDataProvider('Post', array(
                    'pagination' => array(
                        'pageSize' => Yii::app()->params['postsPerPage'],
                    ),
                    'criteria' => $criteria,
                ));
        $this->render('detailPost', array(
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
    public function actionMeme() {        
        $this->render('meme');
    }
    public function actionLoginFacebook() {        
        $this->render('loginfacebook');
    }
}

