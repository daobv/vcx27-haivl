<div id="content" class="pull-left" style="position: relative;">

    <div id="left-bar">
        <a class="new-left-bar" href="#"></a>
        <a class="hot-left-bar" href="#"></a>
        <a class="vote-left-bar" href="#"></a>
    </div>

    <div id="content-left" class="pull-left">
        <div class="wrapper-title">
            <div class="title-left pull-left"></div>
            <div class="title-content pull-left">
                <?php
                if ($menu->root == $menu->id) {
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=> array(
                            $menu->name => array('kenh/'.$menu->alias),
                        ),
                        'separator' => '&nbsp;&nbsp;>&nbsp;&nbsp;',
                    )); 
                } else {
                    $menu_root_name = Menu::model()->findByAttributes(array('id' => $menu->root));

                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=> array(
                            $menu_root_name->name => array('kenh/'.$menu_root_name->alias),
                            $menu->name => array('kenh/'.$menu->alias),
                        ),
                        'separator' => '&nbsp;&nbsp;>&nbsp;&nbsp;',
                    ));    
                }
                ?>
            </div>
            <div class="title-right pull-left"></div>
        </div>

        <div id="cat-contain">
            <?php 
                if (!empty($sub)) {
            ?>

            <div id="cat-sub" class="pull-left full-width">
            <?php 
                    foreach ($sub as $key => $value) {
                        $url = array('kenh/' . $value->alias);
                        $arr[$key] = array(
                            'label' => $value['name'],
                            'url' => $url,
                        );

                    }

                    $this->widget('zii.widgets.CMenu', array(
                        'encodeLabel' => false,
                        'items' => $arr,
                    ));
            ?>    

            </div>
            <?php } ?>
            <div id="list-post-cat" >
                <?php
                    $this->widget('zii.widgets.CListView', array(

                        'dataProvider' => $dataProvider,
                        'summaryText'=>'', 
                        'itemView' => '_view1',
                        'viewData'=>array("dataProvider"=>$dataProvider),
                        )
                    );
                ?>

                <span class="load-more-post" name="5">Click để xem tiếp</span>
            </div>
        </div>
    </div>

    <div id="content-right" class="pull-right">
        <?php $this->widget('Right'); ?>
    </div>

</div>