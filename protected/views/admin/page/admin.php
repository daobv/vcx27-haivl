<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();

//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/imageTooltip.js');
$this->breadcrumbs = array(
    'Page' => array('index'),
    'Danh sách',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('create', "
$('.create-button').click(function(){
	$('.create-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Thêm mới', '#', array('class' => 'create-button')); ?>
<!--<a href="javascript:void(0)" class="colorboxPassword">
    Thay đổi
</a><br>-->
<div class="create-form" style="display:none">
    <?php
    $this->renderPartial('_ajaxForm', array(
        'model' => $model,
        'listData' => $listData
    ));
    ?>
</div>

<?php
$baseUrl = Yii::app()->request->baseUrl;
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
        ));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'page-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'selectableRows' => 2,
    'columns' => array(
        array(
            'id' => 'autoId',
            'class' => 'CCheckBoxColumn',
            'selectableRows' => '50',
        ),
        array(
            'name' => 'categoryId',
            'value' => 'isset($data->category)?$data->category->name:""',
            'filter' => CHtml::activeDropDownList($model, 'categoryId', $listData),
        ),
        // array(
        //     'name' => 'Hình ảnh',
        //     'value' => function($data) {
        //         if (!empty($data->image)){
        //             $item = '<img src="' . Yii::app()->request->baseUrl . '/' . $data->image . '" width=50/>';
        //         }elseif (!empty ($data->linkImg)){
        //             $item = '<img src="' . $data->linkImg . '" width=50/>';
        //         }  elseif (!empty($data->image) and !empty($data->linkUrl)){
        //             $item = '<img src="' . $data->linkImg . '" width=50/>';
        //         } else {
        //             $item = 'No Images';
        //         }
        //         return $item;
        //     },
        //     'type' => 'raw',
        //     'filter' => FALSE,
        //     'sortable' => FALSE,
        // ),
        array(
            'name' => 'title',
            'value' => 'CHtml::textArea("setTitle[$data->id]",$data->title,array("style"=>"width:350px;"))',
            'type' => 'raw',
        ),
        array(// display 'create_time' using an expression
            'name' => 'create_time',
            'value' => 'date("d-m-Y", $data->create_time)',
            'type' => 'raw',
            'filter' => FALSE,
        ),
        array(
            'name' => 'rank',
            'value' => 'CHtml::textField("sortRank[$data->id]",$data->rank)',
            'type' => 'raw',
        ),
        array(
            'name' => 'status',
            'value' => '$data->status==1?"Hiện":"Ẩn"',
            'filter' => array(1 => 'Hiện', 0 => 'Ẩn'),
            'htmlOptions' => array("width" => "50px"),
            'filter' => FALSE,
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}{view}',
            'htmlOptions' => array("width" => "100px"),
        ),
    ),
));
?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('page-grid');
    }
</script>
<div class="button-bottom">
    <span>Tick chọn:</span>
    <?php echo CHtml::ajaxSubmitButton('Filter', array('page/ajaxUpdate'), array(), array("style" => "display:none;")); ?>
    <?php echo CHtml::ajaxSubmitButton('Hiện', array('page/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Ẩn', array('page/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Xóa', array('page/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn có chắc chắn muốn xóa những sản phẩm được chọn?")
        }',)); ?>
    - 
    <span> Cập nhật: </span>
    <?php echo CHtml::ajaxSubmitButton('Tên', array('page/ajaxUpdate', 'act' => 'doTitle'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Nội dung', array('page/ajaxUpdate', 'act' => 'doContent'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Link hình ảnh', array('page/ajaxUpdate', 'act' => 'doLinkImg'), array('success' => 'reloadGrid')); ?>
    <?php echo CHtml::ajaxSubmitButton('Thứ hạng', array('page/ajaxUpdate', 'act' => 'doSortRank'), array('success' => 'reloadGrid')); ?>
</div>
<?php $this->endWidget(); ?>

<style>
    #preview {
        position: absolute;
        border: 1px solid #ccc;
        background: #333;
        padding: 5px;
        display: none;
        color: #fff;
    }

    #preview img {
        max-width: 500px;
        max-height: 500px;
    }
</style>
<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript(
        'colorboxPassword', '
            $(".colorboxPassword").click(function(){
                $(".colorboxPassword").colorbox({
                    href: "' . Yii::app()->createUrl('page/updateContent') . '",
                    opacity: 0,
                    overlayClose:false,
                    fixed:false,
                    data:{
                        "YII_CSRF_TOKEN":"' . Yii::app()->request->csrfToken . '",
                            "id":"397"},
//                    title:"<div style=\"width:100%; font-size:15px; text-align:left; color:black; \"><strong>Thay đổi mật khẩu</strong></div>",
                    type:"POST",
//                    scrolling:false,
                    width:"800px",
                    height:"500px",
                });

            });
    ', CClientScript::POS_END
);
?>