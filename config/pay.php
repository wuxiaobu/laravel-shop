<?php
return [
    'alipay' => [
        'app_id'         => env('ALIPAY_APPID'),
        'ali_public_key' => env('ALIPAY_PUB_KEY'),
        'private_key'    => env('ALIPAY_PRI_KEY'),
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];