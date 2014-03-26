<div class="row-cucna1"  id ="row-cucna1">
    <div class="services" id="list">
        <?php
        echo '<h3>' . $menu->name . ' (' . $count . ')</h3>';

        if (empty($product)) {
            echo "Sản phẩm chưa cập nhật";
        } else {
            foreach ($product as $k => $item) {
                if ($k == 0 or $k % 6 == 0)
                    $class = 'margless';
                else
                    $class = '';
                ?>
                <div class="span2 <?php echo $class; ?>">
                    <div class="item-product">
                        <a href="<?php echo Yii::app()->request->baseUrl . '/san-pham/' . $item->id . '-' . $item->alias . '.html' ?>">

                            <img  src="
                            <?php
                            if (!empty($item->avatar))
                                echo Yii::app()->request->baseUrl . '/' . $item->avatar;
                            else
                                echo Yii::app()->request->baseUrl . '/images/soon.jpg';
                            ?>"></a>
                        <div class="title"><?php
                           echo CHtml::link($item->name, array('/san-pham/'.$item->id . '-' . $item->alias));
                            ?></div>
                        <?php
                        if ($item->price)
                            echo '<span style=" color: #942a25">' . number_format($item->price, 0, "", ".") . ' VNĐ' . '</span>';
                        else
                            echo "Giá liên hệ";
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

</div>
<?php
$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'itemSelector' => 'div.span2',
    'pages' => $pages,
));
?>
<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
        $('#row-cucna1').infinitescroll({'itemSelector':'div.span2','navSelector':'div.infinite_navigation','nextSelector':'div.infinite_navigation a:first','bufferPx':'300'});
    });
    /*]]>*/
</script>