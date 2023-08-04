<?php
/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'klxgoodsoncredit',
    'title'       => [
        'de' => 'koralex - goods on credit',
        'en' => 'koralex - goods on credit',
    ],
    'description' => [
        'de' => 'Makes it possible to buy goods in installments',
        'en' => 'Makes it possible to buy goods in installments',
    ],
    'thumbnail'   => '',
    'version'     => '1.0',
    'author'      => 'koralex',
    'url'         => 'http://localhost.local/',
    'email'       => 'newuser841@gmail.com',
    'extend'      => [
        \OxidEsales\Eshop\Application\Model\Article::class => \Koralex\GoodsOnCredit\Model\Article::class
    ],
    'blocks'      => [
        [
            'template' => 'article_main.tpl',
            'block' => 'admin_article_main_form',
            'file' => 'views/blocks/article_main__admin_article_main_form.tpl',
        ],
        [
            'template' => 'page/details/inc/productmain.tpl',
            'block' => 'details_productmain_selectlists',
            'file' => 'views/blocks/productmain__details_productmain_selectlists.tpl',
        ]
    ],
    'settings'    => []
);
