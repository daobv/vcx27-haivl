<?php

class OnlineController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin';

    public function actionAjaxUpdate() {
        $act = $_GET['act'];
        if ($act == 'doName') {
            $sortNameAll = $_POST['setName'];
            if (count($sortNameAll) > 0) {
                foreach ($sortNameAll as $id => $sortName) {
                    $model = $this->loadModel($id);
                    $model->name = $sortName;
                    $model->save();
                }
            }
        } elseif ($act == 'doNick') {
            $sortNameAll = $_POST['setNick'];
            if (count($sortNameAll) > 0) {
                foreach ($sortNameAll as $id => $sortName) {
                    $model = $this->loadModel($id);
                    $model->nick = $sortName;
                    $model->save();
                }
            }
        } elseif ($act == 'doPhone') {
            $sortNameAll = $_POST['setPhone'];
            if (count($sortNameAll) > 0) {
                foreach ($sortNameAll as $id => $sortName) {
                    $model = $this->loadModel($id);
                    $model->phone = $sortName;
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
        $model = new Online;
        if (isset($_POST['Online'])) {
            $model->attributes = $_POST['Online'];
            if ($model->save())
                echo '1'; exit();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */

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
        $dataProvider = new CActiveDataProvider('Online');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Online('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Online']))
            $model->attributes = $_GET['Online'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Online::model()->findByPk($id);
        if ($model === NULL)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'online-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
