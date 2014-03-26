<?php

class DocumentController extends AdminController {

    public $layout = '//layouts/admin';

    public function actionAjaxUpdate() {
        $act = $_GET['act'];
        if ($act == 'doName') {
            $sortOrderAll = $_POST['setName'];
            if (count($sortOrderAll) > 0) {
                foreach ($sortOrderAll as $id => $name) {
                    $model = $this->loadModel($id);
                    $model->doc_name = $name;
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
            $f = new Gallery();
            $gallery->name = $info['filename'];
            $gallery->image = '/upload/' . date('Ymd') . '/' . $info['basename'];
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

    public function actionCreate() {
        $model = new Document;
        $path = Yii::app()->basePath . '/../files';
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (isset($_POST['Document'])) {
            $model->attributes = $_POST['Document'];
            if (!empty($_FILES['Document']['name']['doc_file'])) {
                $model->doc_file = $_POST['Document']['doc_file'];
                if ($model->validate(array('doc_file'))) {
                    $model->doc_file = CUploadedFile::getInstance($model, 'doc_file');
                } else {
                    $model->doc_file = $model->url;
                }
                $model->doc_file->saveAs($path . '/' . time() . '_' . str_replace('', '_', strtolower($model->doc_file)));
                $model->doc_type = $model->doc_file->getType();
                $model->doc_size = $model->doc_file->getSize() . ' bytes';

                $model->doc_file = time() . '_' . str_replace('', '_', strtolower($model->doc_file));
            } else {
                $model->doc_file = $_POST['Document']['url_link'];
                $model->doc_type = $model->doc_size = 'null';
            }

            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Document');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Document('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Document']))
            $model->attributes = $_GET['Document'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $model = Document::model()->findByPk($_GET['id']);
        if (!empty($model)) {
            $delete = Document::model()->deleteByPk($model->id);
            if (!empty($model->doc_type))
                unlink(Yii::app()->basePath . '/../files/' . $model->doc_file);
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function loadModel($id) {
        $model = Document::model()->findByPk($id);
        if ($model === NULL)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'document-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

?>
