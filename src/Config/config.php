<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Cài Đặt API Key
    |--------------------------------------------------------------------------
    |
    | Cài đặt và copy Public Key và Private Key tại trang sau
    | https://www.coinpayments.net/index.php?cmd=acct_api_keys
    |
    | Sau đó vào link này để lấy Your Merchant ID:
    | https://www.coinpayments.net/acct-settings
    */

    'public_key'    => env('COINPAYMENT_PUBLIC_KEY', ''),
    'private_key'   => env('COINPAYMENT_PRIVATE_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Middleware để tạo thanh toán
    |--------------------------------------------------------------------------
    |
    | Cài đặt middleware tự chọn
    | bạn có thể chọn "auth" hoặc "auth:guard"
    |
    */
    
    'middleware' => ['auth'],

    /*
    |--------------------------------------------------------------------------
    | Cài Đặt IPN 
    |--------------------------------------------------------------------------
    |
    | Nếu bạn sử dụng IPN để lấy callback response thông tin chuyển khoản
    | thì cài đặt IPN vao` bên dưới
    |
    */

    'ipn' => [
        'activate' => env('COINPAYMENT_IPN_ACTIVATE', false),
        'config' => [
            'coinpayment_merchant_id'       => env('COINPAYMENT_MARCHANT_ID', ''), // Đọc hướng dẫn cách lấy Merchant_ID
            'coinpayment_ipn_secret'        => env('COINPAYMENT_IPN_SECRET', ''), // Đọc hướng dẫn trên đầu
            'coinpayment_ipn_debug_email'   => env('COINPAYMENT_IPN_DEBUG_EMAIL', ''), // Đọc hướng dẫn trên đầu
        ]
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Cài Đặt Tiền Tệ
    |--------------------------------------------------------------------------
    |
    | Dùng Các Mã Tiền Sau Để Convert Ra Coin
    | VND, USD, CAD, EUR, ARS, AUD, AZN, BGN, BRL, BYN, CHF, CLP, CNY, COP, CZK
    | DKK, GBP, GIP, HKD, HUF, IDR, ILS, INR, IRR, IRT, ISK, JPY, KRW, LAK, MKD, MXN, 
    | MYR, NGN, NOK, NZD, PEN, PHP, PKR, PLN, RON, RUB, SEK, SGD, THB, TRY, TWD, UAH,
    |
    */

    'default_currency' => env('COINPAYMENT_CURRENCY', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | Cài Đặt Header
    |--------------------------------------------------------------------------
    */

    'header' => [
        'default' => 'logo',
        'type' => [
            'logo' => '/coinpayment.logo.png',
            'text' => 'Mô tả thanh toán đơn hàng'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Font Chữ
    |--------------------------------------------------------------------------
    */

    'font' => [
        'family' => "'Roboto', sans-serif"
    ],
];
