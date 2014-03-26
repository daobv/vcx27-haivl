<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>
<div class="row-fluid">
    <div class="span9">
        <?php if (!empty($model)) { ?>
        <h4 class="title"><?php if ($model->categoryId == 109 or $model->categoryId == 110)  echo $model->category->name.' - '. $model->title; else echo $model->title ?></h4>
            <div class="box-content">
                <p><?php echo $model->content_1 ?></p>
                <p><?php echo $model->content ?></p>

            </div>
        <?php
        } else {
            echo 'Chưa cập nhật';
        }
        ?>
    </div>
    <div class="span3">
<?php $this->widget('Right'); ?>

    </div>
</div>
