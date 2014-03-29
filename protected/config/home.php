<?php
    return CMap::mergeArray(
        require(dirname(__FILE__) . '/main.php'),
        array(
            'components' => array(
                // uncomment the following to enable URLs in path-format
                'urlManager' => array(
                    'urlFormat' => 'path',
                    'showScriptName' => false,
                    'urlSuffix' => '.html',
                    'rules'     => array(
                        'dang-nhap/' => 'site/loginfacebook',
                        'dang-bai/' => 'site/upload',
                        'che-anh/' => 'site/meme',
                        'kenh/<alias>' => 'site/category',
                        'bai-viet/<alias>' => 'site/detailPost',
                        'gioi-thieu/' => 'site/about',
                        'lien-he/' => 'site/contact',
                        'faq/' => 'site/faq',
                        'dieu-khoan' => 'site/dieukhoan',
                        'tin-tuc' => 'site/news',
                        'tin-tuc/<alias>' => 'site/detail',
                        'quang-cao/<alias>' => 'site/detail',
                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ),
                ),
            ),
        )
    );
?>