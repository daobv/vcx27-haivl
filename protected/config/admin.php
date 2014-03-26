<?php
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'), array(
        'name' => 'Quản lý sản phẩm',
        'language' => 'vi',
        'components' => array(
            'urlSuffix' => FALSE,
            'urlManager' => array(
                'rules' => array(
                    'them-danh-muc' => array('album/create', 'caseSensitive' => false),
                    'danh-muc' => array('album/admin', 'caseSensitive' => false),
                ),
            ),
        ),
    )
);
?>