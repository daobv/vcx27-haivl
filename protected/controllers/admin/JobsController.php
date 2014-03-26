<?php

class JobsController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/admin';

    public function actionAjaxUpdate() {
        $act = $_GET['act'];
        if ($act == 'dowage') {
            $sortOrderAll = $_POST['setWage'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $sortOrder) {
                    $model = $this->loadModel($id);
                    $model->wage = $sortOrder;
                    $model->save();
                }
            }
        } elseif ($act == 'doLocation') {
            $sortOrderAll = $_POST['setLocation'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $name) {
                    $model = $this->loadModel($id);
                    $model->location = $name;
                    $model->alias = MString::convertToAlias($name);
                    $model->save();
                }
            }
        } elseif ($act == 'doProbation_period') {
            $sortOrderAll = $_POST['setProbation_period'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $name) {
                    $model = $this->loadModel($id);
                    $model->probation_period = $name;
                    $model->save();
                }
            }
        }elseif ($act == 'doJob_type') {
            $sortOrderAll = $_POST['setJob_type'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $name) {
                    $model = $this->loadModel($id);
                    $model->job_type = $name;
                    $model->save();
                }
            }
        }elseif ($act == 'doUpdate_time') {
            $sortOrderAll = $_POST['setUpdate_time'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $time) {
                    $model = $this->loadModel($id);
                    $model->content = $time;
                    $model->update_time = strtotime($time);
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
                        if ($act == 'doCategory')
                            $model->categories = 1;
                        if ($act == 'doNotCategory')
                            $model->categories = 0;
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
        $model = new Jobs;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Jobs'])) {
            $model->attributes = $_POST['Jobs'];
            $model->userId = Yii::app()->user->id;
            $model->create_time = time();
            $model->update_time = strtotime($_POST['Jobs']['update_time']);
            $model->alias = MString::convertToAlias($_POST['Jobs']['location']);
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create', array(
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
        $model->setScenario('update');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Jobs'])) {
            $model->attributes = $_POST['Jobs'];
            if ($model->save())
                $this->redirect(array('admin'));
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
        $dataProvider = new CActiveDataProvider('Jobs');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Jobs('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Jobs']))
            $model->attributes = $_GET['Jobs'];

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
        $model = Jobs::model()->findByPk($id);
        if ($model === NULL)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
