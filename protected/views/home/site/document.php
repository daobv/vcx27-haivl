<div class="row-cucna1">
    <div class="services">
        <div class="span12 margless">
            <h3>TÀI LIỆU ( <?php echo $countDoc ?> )</h3>
            <?php
            $i = 1;
            foreach ($model as $item) {
                if ($item->doc_tab == Document::DOCUMENT) {
                    ?>
                    <div class="span4"><?php echo $i++ ?>. <a href="<?php echo Yii::app()->request->baseUrl ?>/files/<?php echo $item->doc_file ?>"><?php echo $item->doc_name ?></a></div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="span6 margless">
            <h3>PHẦN MỀM ( <?php echo $countSoft ?> )</h3>
            <?php
            $i = 1;
            foreach ($model as $item) {
                if ($item->doc_tab == Document::SOFTWARE) {
                    ?>
                    <p><?php echo $i++ ?>. <a href="<?php echo Yii::app()->request->baseUrl ?>/files/<?php echo $item->doc_file ?>"><?php echo $item->doc_name ?></a></p>
                    <?php
                }
            }
            ?>
        </div>
        <div class="span6 ">
            <h3>BÁO GIÁ ( <?php echo $countPrice ?> )</h3>
            <?php
            $i = 1;
            foreach ($model as $item) {
                if ($item->doc_tab == Document::PRICE) {
                    ?>
                    <p><?php echo $i++ ?>. <a href="<?php echo Yii::app()->request->baseUrl ?>/files/<?php echo $item->doc_file ?>"><?php echo $item->doc_name ?></a></p>
                    <?php
                }
            }
            ?>
        </div>

    </div>
</div>