<?php

class MenuController extends AdminController {

//    public $defaultAction='admin';
            public $model, $open_nodes;

    public function init() {
        $this->registerCssAndJs('webroot.js.fancybox', '/jquery.fancybox.pack.js', '/jquery.fancybox.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/client_val_form.css', 'screen');
        $this->registerAssets();
        $f = Menu::model()->findAll(array('order' => 'lft'));
        $identifiers = array();
        foreach ($f as $n => $category) {
            $identifiers[] = "'" . 'node_' . $category->id . "'";
        }
        $this->open_nodes = implode(',', $identifiers);
    }

    public function actionAdmin() {
        $this->layout = 'admin';
        $dataProvider = new CActiveDataProvider('Menu');
        $this->render('admin', array('dataProvider' => $dataProvider));
    }

    public function loadModel($id) {
        $this->model = Menu::model()->findByPk($id);
        if ($this->model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
    }

    protected function returnModel($id) {
        $model = Menu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function printULTree_noAnchors() {
        $categories = Menu::model()->findAll(array('order' => 'lft'));
        $level = 0;
        foreach ($categories as $n => $category) {
            if ($category->level == $level)
                echo CHtml::closeTag('li') . "\n";
            elseif ($category->level > $level)
                echo CHtml::openTag('ul') . "\n";
            else {
                echo CHtml::closeTag('li') . "\n";
                for ($i = $level - $category->level; $i; $i--) {
                    echo CHtml::closeTag('ul') . "\n";
                    echo CHtml::closeTag('li') . "\n";
                }
            }
            echo CHtml::openTag('li');
            echo CHtml::encode($category->name);
            $level = $category->level;
        }
        for ($i = $level; $i; $i--) {
            echo CHtml::closeTag('li') . "\n";
            echo CHtml::closeTag('ul') . "\n";
        }
    }

    public function actionFetchTree($id = 'admin') {
        parent::actionFetchTree($id);
    }

    public function actionRename() {
        $new_name = $_POST['new_name'];
        $id = $_POST['id'];
        $this->loadModel($id);
        $this->model->name = $new_name;
        $this->model->alias = MString::convertToAlias($new_name);
        if ($this->model->saveNode()) {
            echo json_encode(array('success' => true));
            Yii::app()->end();
        } else {
            echo json_encode(array('success' => false));
            Yii::app()->end();
        }
    }

    public function actionRemove() {
        $id = $_POST['id'];
        $this->loadModel($id);
        if ($this->model->deleteNode()) {
            echo json_encode(array('success' => true));
            Yii::app()->end();
        } else {
            echo json_encode(array('success' => false));
            Yii::app()->end();
        }
    }

    public function actionReturnForm() {
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array('jquery.min.js' => false, 'jquery.js' => false, 'jquery.fancybox-1.3.4.js' => false, 'jquery.jstree.js' => false, 'jquery-ui-1.8.12.custom.min.js' => false, 'json2.js' => false);
        if (isset($_POST['update_id']))
            $this->loadModel($_POST['update_id']);
        else
            $this->model = new Menu;
        $this->renderPartial('_form', array('parent_id' => !empty($_POST['parent_id']) ? $_POST['parent_id'] : ''), false, true);
    }

    public function actionReturnView() {
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array('jquery.min.js' => false, 'jquery.js' => false, 'jquery.fancybox-1.3.4.js' => false, 'jquery.jstree.js' => false, 'jquery-ui-1.8.12.custom.min.js' => false, 'json2.js' => false);
        $this->loadModel($_POST['id']);
        $this->renderPartial('view', array(), false, true);
    }

    public function actionCreateRoot() {
        if (isset($_POST['Menu'])) {
            $new_root = new Menu;
            $new_root->attributes = $_POST['Menu'];
            $new_root->alias = MString::convertToAlias($_POST['Menu']['name']);
            if ($new_root->saveNode(false)) {
                echo json_encode(array('success' => true, 'id' => $new_root->primaryKey));
                Yii::app()->end();
            } else {
                echo json_encode(array('success' => false, 'message' => 'Error.Root Menu was not created.'));
                Yii::app()->end();
            }
        }
    }

    public function actionCreate() {
        if (isset($_POST['Menu'])) {
            $model = new Menu;
            $model->attributes = $_POST['Menu'];
            $model->alias = MString::convertToAlias($_POST['Menu']['name']);
            $this->loadModel($_POST['parent_id']);
            if ($this->model->level == 2){
                $model->root1 = $this->model->id;
            }
            if ($model->appendTo($this->model)) {
                echo json_encode(array('success' => true, 'id' => $model->primaryKey));
                Yii::app()->end();
            } else {
                echo json_encode(array('success' => false, 'message' => 'Error.Menu was not created.'));
                Yii::app()->end();
            }
        }
    }

    public function actionUpdate() {
        if (isset($_POST['Menu'])) {
            $this->loadModel($_POST['update_id']);
            $this->model->attributes = $_POST['Menu'];
            $this->model->alias = MString::convertToAlias($_POST['Menu']['name']);
            if ($this->model->saveNode(false)) {
                echo json_encode(array('success' => true));
            }
            else
                echo json_encode(array('success' => false));
        }
    }

    public function actionMoveCopy() {
        $moved_node_id = $_POST['moved_node'];
        $new_parent_id = $_POST['new_parent'];
        $new_parent_root_id = $_POST['new_parent_root'];
        $previous_node_id = $_POST['previous_node'];
        $next_node_id = $_POST['next_node'];
        $copy = $_POST['copy'];
        $moved_node = $this->returnModel($moved_node_id);
        if ($new_parent_root_id != 'root') {
            $new_parent = $this->returnModel($new_parent_id);
            if ($previous_node_id != 'false')
                $previous_node = $this->returnModel($previous_node_id);
            if ($copy == 'false') {
                if ($previous_node_id == 'false' && $next_node_id == 'false') {
                    if ($moved_node->moveAsFirst($new_parent)) {
                        echo json_encode(array('success' => true));
                        Yii::app()->end();
                    }
                } elseif ($previous_node_id == 'false' && $next_node_id != 'false') {
                    if ($moved_node->moveAsFirst($new_parent)) {
                        echo json_encode(array('success' => true));
                        Yii::app()->end();
                    }
                } elseif ($previous_node_id != 'false' && $next_node_id == 'false') {
                    if ($moved_node->moveAsLast($new_parent)) {
                        echo json_encode(array('success' => true));
                        Yii::app()->end();
                    }
                } elseif ($previous_node_id != 'false' && $next_node_id != 'false') {
                    if ($moved_node->moveAfter($previous_node)) {
                        echo json_encode(array('success' => true));
                        Yii::app()->end();
                    }
                }
            } else {
                $copied_node = new Menu;
                $copied_node->attributes = $moved_node->attributes;
                $copied_node->id = null;
                if ($copied_node->appendTo($new_parent)) {
                    echo json_encode(array('success' => true, 'id' => $copied_node->primaryKey));
                    Yii::app()->end();
                }
            }
        } else {
            if (!$moved_node->isRoot()) {
                if ($moved_node->moveAsRoot()) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'Node is already a Root.Roots are ordered by id.'));
            }
        }
    }

    protected function performAjaxValidation() {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-form') {
            echo CActiveForm::validate($this->model);
            Yii::app()->end();
        }
    }

}
