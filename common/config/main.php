<?php

use kartik\grid\Module;
use yii\i18n\Formatter;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => Formatter::class,
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i:s',
            'timeFormat' => 'H:i:s',
            'currencyCode' => 'RUB',
            'locale' => 'ru_RU', //your language locale
            'defaultTimeZone' => 'Europe/Moscow', // time zone
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => Module::class
        ]
    ],
];
