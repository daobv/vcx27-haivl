<?php $this->beginContent('//layouts/main'); ?>
<style>

    .grid-view .filters select {
        width: 100px !important;

    }
</style>

<!-- header -->
<div id="mainmenu">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'items' => array(
            array('label' => 'Home', 'url' => array('site/index')),
            array('label' => 'Module', 'url' => array('category/admin')),
            array('label' => 'Kênh', 'url' => array('menu/admin')),
            array('label' => 'Bài viết', 'url' => array('post/admin')),
            
            array('label' => 'Các mục khác', 'url' => array('page/admin'), 'active' => Yii::app()->controller->id === 'page'),
        ),
    ));
    ?>
    <div class="information">
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Xin chào ' . Yii::app()->user->name),
                array('label' => 'Thay đổi mật khẩu', 'url' => array('user/changePassword')),
                array('label' => 'Thoát', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
            ),
        ));
        ?>
    </div>
</div>
<!-- mainmenu -->

<?php
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => $this->breadcrumbs,
));
?><!-- breadcrumbs -->
<div class="container">
    <div id="content">
<?php echo $content; ?>
    </div><!-- content -->
    <div class="span-5 last">
        <div id="sidebar">
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'title' => 'Chức năng',
));
$this->widget('zii.widgets.CMenu', array(
    'items' => $this->menu,
    'htmlOptions' => array('class' => 'operations'),
));
$this->endWidget();
?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>