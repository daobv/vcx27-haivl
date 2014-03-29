<?php

class PostController extends AdminController {

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
                    $model->save();
                }
            }
        } elseif ($act == 'doPrice') {
            $sortOrderAll = $_POST['setPrice'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $price) {
                    $model = $this->loadModel($id);
                    $model->price = $price;
                    $model->save();
                }
            }
        } elseif ($act == 'doWarranty') {
            $sortOrderAll = $_POST['setWarranty'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $sortOrder) {
                    $model = $this->loadModel($id);
                    $model->warranty = $sortOrder;
                    $model->save();
                }
            }
        } elseif ($act == 'doOrigin') {
            $sortOrderAll = $_POST['setWarranty'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $sortOrder) {
                    $model = $this->loadModel($id);
                    $model->origin = $sortOrder;
                    $model->save();
                }
            }
        } elseif ($act == 'doContent1') {
            $sortOrderAll = $_POST['setContent1'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $sortOrder) {
                    $model = $this->loadModel($id);
                    $model->content_1 = $sortOrder;
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
                        if ($act == 'doHome')
                            $model->home = 1;
                        if ($act == 'doNotHome')
                            $model->home = 0;
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

    private function _selectList() {
        $categories = Menu::model()->findAll(array('order' => 'root,lft'));
        $level = 0;
        $indent = '';
        $listData = array();
        foreach ($categories as $n => $category) {
            if ($category->level == $level) {
                
            } elseif ($category->level > $level) {
                $indent.='--';
            } else {
                $indent = substr($indent, -2);
            }
            $listData[$category->id] = $indent . $category->name;
            $level = $category->level;
        }
        return $listData;
    }

    public function actionBatchUpload() {
        if (isset($_POST['categoryId'])) {
            $category = Category::model()->findByPk($_POST['categoryId']);
            $this->render('multiple_upload', array('category' => $category));
        } else {
            $this->render('choose_category');
        }
    }

    public function actionUpload() {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", FALSE);
        header("Pragma: no-cache");

        // Settings
        $targetDir = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . date('Ymd');

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, TRUE);
        }
        $cleanupTargetDir = TRUE; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds
        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);
        // Get parameters
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

        // Clean the fileName for security reasons
        $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

        // Make sure the fileName is unique but only if chunking is disabled
        if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
            $ext = strrpos($fileName, '.');
            $fileName_a = substr($fileName, 0, $ext);
            $fileName_b = substr($fileName, $ext);

            $count = 1;
            while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
                $count++;

            $fileName = $fileName_a . '_' . $count . $fileName_b;
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Create target dir
        if (!file_exists($targetDir))
            @mkdir($targetDir);

        // Remove old temp files
        if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
            while (($file = readdir($dir)) !== FALSE) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                    @unlink($tmpfilePath);
                }
            }

            closedir($dir);
        } else
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');


        // Look for the content type header
        if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];

        if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];

        // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
        if (strpos($contentType, "multipart") !== FALSE) {
            if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                // Open temp file
                $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {
                    // Read binary input stream and append it to temp file
                    $in = fopen($_FILES['file']['tmp_name'], "rb");

                    if ($in) {
                        while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                    } else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    fclose($in);
                    fclose($out);
                    @unlink($_FILES['file']['tmp_name']);
                } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        } else {
            // Open temp file
            $out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                // Read binary input stream and append it to temp file
                $in = fopen("php://input", "rb");

                if ($in) {
                    while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

                fclose($in);
                fclose($out);
            } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
            //Save o day
            $info = pathinfo($filePath);
            $gallery = new Gallery();
            $gallery->name = $info['filename'];
            $gallery->image = '/upload/' . date('Ymd') . '/'. $info['basename'];
            $gallery->galleryId = $_GET['galleryId'];
            $gallery->create_time = date('Ymd');
            $gallery->status = 1;
            $gallery->save();

            echo json_encode(array(
                'jsonrpc' => '2.0',
                'result' => $filePath,
            ));
            die;
        }
        // Return JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
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
        $model = new Post;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $model->create_time = time();
            $model->alias = MString::convertToAlias($_POST['Post']['name']);
            if ($model->save())
                echo '1';
            else
                echo '0';
            exit();
        };
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setScenario('update');
        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            $menu = Menu::model()->findByPk($_POST['Post']['menuId']);
            $model->rootId = $menu->root;
            $model->alias = MString::convertToAlias($_POST['Post']['name']);
            if ($model->save()) {
                $keyword = Keyword::model()->findByAttributes(array('titleId' => $model->id));
                $keyword->model = Post::MODELPOST;
                $keyword->title = $menu->name . ': ' . $model->name;
                $keyword->alias = 'bai-viet/' . $model->id . '-' . $model->alias;
                $keyword->img = $model->avatar;
                $keyword->content = $model->content;
                if ($keyword->save())
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('update', array(
            'model' => $model,
            'listData' => $this->_selectList()
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Post');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Post('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Post']))
            $model->attributes = $_GET['Post'];

        $this->render('admin', array(
            'model' => $model,
            'listData' => $this->_selectList()
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Post::model()->findByPk($id);
        if ($model === NULL)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Post $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
