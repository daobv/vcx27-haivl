<?php

$baseUrl = Yii::app()->request->baseUrl;



$cs = Yii::app()->getClientScript();



?>

<div id="content" class="pull-left">

    <div id="content-left" class="pull-left">

        <div id="kenh1" class="full-width pull-left">

            <div class="wrapper-title">

                <div class="title-left pull-left"></div>

                <div class="title-content pull-left"><?php echo CHtml::link('KÊNH 1',array('danh-muc/kenh-1')); ?></div>

                <div class="title-right pull-left"></div>

            </div>



            <?php

                $this->widget('zii.widgets.CListView', array(

                    'dataProvider' => $dataProvider,

                    'summaryText'=>'', 

                    'itemView' => '_view',

                    'id' => 'product',

                    'itemsCssClass' => 'slides_container',

                    'viewData'=>array("dataProvider"=>$dataProvider),

                    )

                );

            ?>

        </div>



        <div id="kenh2" class="full-width pull-left">

            <div class="wrapper-title">

                <div class="title-left pull-left"></div>

                <div class="title-content pull-left"><?php echo CHtml::link('KÊNH 2',array('danh-muc/kenh-2')); ?></div>

                <div class="title-right pull-left"></div>

            </div>

            <?php

                $this->widget('zii.widgets.CListView', array(

                    'dataProvider' => $dataProvider1,

                    'summaryText'=>'', 

                    'itemView' => '_view',

                    'id' => 'product1',

                    'itemsCssClass' => 'slides_container',

                    'viewData'=>array("dataProvider"=>$dataProvider1),

                    )

                );

            ?>

        </div>



        <div id="ads-center"><?php $this->widget('AdsCenter'); ?></div>

        

        <div id="kenh3" class="full-width pull-left">

            <div class="wrapper-title">

                <div class="title-left pull-left"></div>

                <div class="title-content pull-left"><?php echo CHtml::link('KÊNH 3',array('danh-muc/kenh-3')); ?></div>

                <div class="title-right pull-left"></div>

            </div>

            <?php

                $this->widget('zii.widgets.CListView', array(

                    'dataProvider' => $dataProvider2,

                    'summaryText'=>'', 

                    'itemView' => '_view',

                    'id' => 'product2',

                    'itemsCssClass' => 'slides_container',

                    'viewData'=>array("dataProvider"=>$dataProvider2),

                    )

                );

            ?>

        </div>



        <div id="kenh4" class="full-width pull-left">

            <div class="wrapper-title">

                <div class="title-left pull-left"></div>

                <div class="title-content pull-left"><?php echo CHtml::link('KÊNH 4',array('danh-muc/kenh-4')); ?></div>

                <div class="title-right pull-left"></div>

            </div>

            <?php

                $this->widget('zii.widgets.CListView', array(

                    'dataProvider' => $dataProvider3,

                    'summaryText'=>'', 

                    'itemView' => '_view',

                    'id' => 'product3',

                    'itemsCssClass' => 'slides_container',

                    'viewData'=>array("dataProvider"=>$dataProvider3),

                    )

                );

            ?>

        </div>



    </div>

    <div id="content-right" class="pull-right">

        <?php $this->widget('Right'); ?>

    </div>



</div>

