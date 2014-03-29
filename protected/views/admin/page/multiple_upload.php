<?php
    /**
     * Created by $Mitonios Editor.
     * User: $Mitonios
     * Date: 28/02/13
     * Time: 4:16 PM
     */
    /* @var $category Category */
    $this->breadcrumbs = array(
        'Posts' => array('index'),
        'Batch Upload in ' . $category->name,
    );

    $this->menu = array(
        array('label' => 'Danh sách', 'url' => array('admin')),
    );
?>
<h1>Upload hàng loạt vào <?php echo $category->name?></h1>
<?php
    Yii::app()->clientScript->registerCoreScript('jquery');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/js/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plupload/plupload.full.js');
?>
<div id="uploader">You browser doesn't have HTML 4 support.</div>
<script type="text/javascript">
    $(function () {
        //===== File uploader =====//
        $("#uploader").pluploadQueue({
            runtimes:'html5,html4',
            url:'<?php echo $this->createUrl('upload', array('categoryId' => $category->id))?>',
            max_file_size:'5mb',
            //unique_names:true,
            init:{
                UploadComplete:function (up, files) {
                },
                FileUploaded:function (up, file, info) {
                    // Called when a file has finished uploading
                    var json_data_object = eval("(" + info.response + ")");
                }
            }
        });
    })
</script>