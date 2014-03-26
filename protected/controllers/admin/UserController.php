<?php

class UserController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin';

    public function actionAjaxUpdate() {
        $act = $_GET['act'];
        if ($act == 'doSortRank') {
            $sortOrderAll = $_POST['sortRank'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $sortOrder) {
                    $model = $this->loadModel($id);
                    $model->rank = $sortOrder;
                    $model->save();
                }
            }
        } elseif ($act == 'doName') {
            $sortOrderAll = $_POST['setName'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $name) {
                    $model = $this->loadModel($id);
                    $model->name = $name;
                    $model->alias = MString::convertToAlias($name);
                    $model->save();
                }
            }
        } elseif ($act == 'doContent') {
            $sortOrderAll = $_POST['setContent'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $name) {
                    $model = $this->loadModel($id);
                    $model->content = $name;
                    $model->save();
                }
            }
        } else {
            $autoIdAll = $_POST['autoId'];
            if (count($autoIdAll) > 0) {
                foreach ($autoIdAll as $autoId) {
                    $model = $this->loadModel($autoId);
                    if ($act == 'doDelete') {
                        $model->delete();
                    } else {
                        if ($act == 'doActive')
                            $model->status = 1;
                        if ($act == 'doInactive')
                            $model->status = 0;
                        if ($act == 'doFeature')
                            $model->feature = 1;
                        if ($act == 'doNotFeature')
                            $model->feature = 0;
                        if ($model->save())
                            echo 'ok';
                        else
                            throw new Exception("Sorry", 500);
                    }
                }
            }
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->dateCreated = new CDbExpression('NOW()');
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionChangePassword() {
        $model = new ChangePassword();
        if (!empty($_POST['ChangePassword'])) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if (!empty($user)) {
                if ($user->email == $_POST['ChangePassword']['email']) {
                    $user->password = $_POST['ChangePassword']['password'];
                    if ($user->save())
                        Yii::app()->user->setFlash('user', '<p style="margin-left:100px">Bạn đã thay đổi mật khẩu thành công</p>');
                    $this->refresh();
                }
            }
        }
        $this->render('changePassword', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Album'])) {
            $model->attributes = $_POST['Album'];
            $model->alias = MString::convertToAlias($_POST['Album']['name']);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Album');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Album('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Album']))
            $model->attributes = $_GET['Album'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === NULL)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'album-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
