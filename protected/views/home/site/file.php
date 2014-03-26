<div class="row-fluid">

    <div class="span9">

            <h4 class="title"><?php echo $fileId ?></h4>
                    <div class="box-content">
            <ul class="nav">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $dataProvider,
                    'itemView' => '_file',
                    'template' => '{items} {pager}',
                        )
                );
                ?>
            </ul>
        </div>
    </div>
    <div class="span3">
        <?php $this->widget('Right'); ?>
    </div>
</div>
