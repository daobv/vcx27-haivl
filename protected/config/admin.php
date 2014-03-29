<?php
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'), array(
        'name' => 'Quản lý bài viết',
        'language' => 'vi',
        'components' => array(
            'urlSuffix' => FALSE,
            'urlManager' => array(
                'rules' => array(
                    // 'them-kenh' => array('album/create', 'caseSensitive' => false),
                    // 'kenh' => array('album/admin', 'caseSensitive' => false),
                ),
            ),
        ),
    )
);
?>