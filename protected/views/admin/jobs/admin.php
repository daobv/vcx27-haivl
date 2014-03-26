<?php
$this->breadcrumbs = array(
    'Danh mục tuyển dụng' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'Thêm mới', 'url' => array('create'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Danh sách</h1>

<?php echo CHtml::link('Tìm kiếm', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
        ));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'album-grid',
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
            'name' => 'location',
            'value' => 'CHtml::textField("setLocation[$data->id]",$data->location)',
            'type' => 'raw',
        ),
        array(
            'name' => 'education',
            'value' => function($data) {
                if ($data->education == Jobs::JOB_UNIVERSITY)
                    $item = 'Đại học';
                elseif ($data->education == Jobs::JOB_COLLEGE)
                    $item = 'Cao đẳng';
                elseif ($data->education == Jobs::JOB_INTERMEDIATE)
                    $item = 'Trung cấp';
                else
                    $item = 'Lao động phổ thông';
                return $item;
            },
            'filter' => array(Jobs::JOB_UNIVERSITY => 'Đại học', Jobs::JOB_COLLEGE => 'Cao Đẳng', Jobs::JOB_INTERMEDIATE => ' Trung cấp', Jobs::JOB_GENERAL => 'Lao động phổ thông'),
        ),
        array(
            'name' => 'wage',
            'value' => 'CHtml::textField("setWage[$data->id]",$data->wage)',
            'type' => 'raw',
        ),
        array(
            'name' => 'gender',
            'value' => function($data) {
                if ($data->gender == 1)
                    $item = 'Nam';
                elseif ($data->gender == 0)
                    $item = 'Nữ';
                else
                    $item = 'Nam/Nữ';
                return $item;
            },
            'filter' => array(1 => 'Nam', '2' => 'Nữ', '10' => 'Nam/Nữ'),
        ),
        array(
            'name' => 'job_type',
            'value' => 'CHtml::textField("setJob_type[$data->id]",$data->job_type,array("style"=>"width:100px;"))',
            'type' => 'raw',
            'filter' => FALSE,
        ),
        array(
            'name' => 'probation_period',
            'value' => 'CHtml::textField("setProbation_period[$data->id]",$data->probation_period,array("style"=>"width:100px;"))',
            'type' => 'raw',
            'filter' => FALSE,
        ),
        array(// display 'create_time' using an expression
            'name' => 'create_time',
            'value' => 'CHtml::textField("setCreate_time[$data->id]", date("d-m-Y", $data->create_time),array("style"=>"width:80px;"))',
            'type' => 'raw',
            'filter' => FALSE,
        ),
        array(// display 'create_time' using an expression
            'name' => 'update_time',
            'value' => 'CHtml::textField("setUpdate_time[$data->id]", date("d-m-Y", $data->update_time),array("style"=>"width:80px;"))',
            'type' => 'raw',
            'filter' => FALSE,
        ),
        array(
            'name' => 'status',
            'value' => '$data->status==1?"Hiện":"Ẩn"',
            'filter' => array(1 => 'Hiện', 0 => 'Ẩn'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('album-grid');
    }
</script>
<span>Tick chọn:</span>
<?php echo CHtml::ajaxSubmitButton('Filter', array('jobs/ajaxUpdate'), array(), array("style" => "display:none;")); ?>
<?php echo CHtml::ajaxSubmitButton('Hiện', array('jobs/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Ẩn', array('jobs/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
<br/><BR>
<span> Cập nhật: </span>
<?php echo CHtml::ajaxSubmitButton('Vị trí', array('jobs/ajaxUpdate', 'act' => 'doLocation'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Mức lương', array('jobs/ajaxUpdate', 'act' => 'dowage'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Hình thức làm việc', array('jobs/ajaxUpdate', 'act' => 'doJob_type'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Thời gian thử việc', array('jobs/ajaxUpdate', 'act' => 'doProbation_period'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Thứ hạng', array('jobs/ajaxUpdate', 'act' => 'doSortRank'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Ngày hết hạn', array('jobs/ajaxUpdate', 'act' => 'doUpdate_time'), array('success' => 'reloadGrid')); ?>
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