<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
?>
<div class="row-fluid">
    <div class="span9">
        <h4 class="title"><?php echo $model->menu->name ?></h4>
        <div class="box-content">
            <div class="row-fluid">
                <div class="span6">
                    <img src="<?php echo $baseUrl . '/' . $model->avatar ?>" alt="<?php $model->name ?>" title="<?php $model->name ?>"/>       
                </div>
                <div class="span6">
                    <ul class="nav">
                        <li>Tên sản phẩm: <strong><?php echo $model->name ?></strong></li>
                        <li><?php echo $model->content_1 ?></li>
                        <li>Giá: <strong><?php if ($model->price == 0) echo "Liên hệ"; else echo number_format($model->price, 0) . ' VNĐ' ?></strong></li>
                        <li>Bảo hành: <strong><?php echo $model->warranty ?></strong></li>
                        <li>Xuất xứ: <strong><?php echo $model->origin ?></strong></li>
                    </ul>
                </div>

            </div>
            <h4>THÔNG TIN CHI TIẾT</h4>
            <p><?php if (!empty($model->content)) echo $model->content; else echo 'Nội dung chi tiết chưa cập nhật'; ?></p>
            <hr>
            <div id="product">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_view',
                        )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span3">
        <?php $this->widget('Right'); ?>

    </div>
</div>
