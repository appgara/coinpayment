# CoinPayments bản Laravel [USDT-ERC20]

## Package thanh toán Coin bằng CoinPayments cho Laravel v7.0+

![Ảnh Minh Hoạ](https://github.com/appgara/coinpayment-laravel/blob/master/vi-du.png?raw=true)

## Yêu Cầu
* Laravel v7.0+
* PHP >= v7.2+

## Cài Đặt Vào Web Laravel
Bạn có thể cài đặt package này qua composer:
```
$ composer require appgara/coinpayment-laravel
```

Xuất vendor
```
$ php artisan vendor:publish --tag=coinpayment
```

Cài Đặt CoinPayment
```
$ php artisan coinpayment:install
```

Vậy là bạn đã cài xong package này.

## Hướng Dẫn Sử Dụng
Tạo nút thanh toán. Ví dụ cho controller của bạn
```
  . . . 
  /*
  *   @required true
  */
  $transaction['amountTotal'] = (FLOAT) 37.5;
  $transaction['note'] = 'Mô tả thanh toán';
  $transaction['buyer_email'] = 'email@khach-hang.com';
  $transaction['redirect_url'] = url('/trang_thanh_toan');

  /*
  *   @required true
  *   @example first item
  */
  $transaction['items'][] = [
    'itemDescription' => 'Sản Phẩm 01',
    'itemPrice' => (FLOAT) 7.5, // USD hoặc VND được cài đặt ở /src/config/config.php
    'itemQty' => (INT) 1,
    'itemSubtotalAmount' => (FLOAT) 7.5 // USD hoặc VND được cài đặt ở /src/config/config.php
  ];

  /*
  *   @example second item
  */
  $transaction['items'][] = [
    'itemDescription' => 'Sản Phẩm 02',
    'itemPrice' => (FLOAT) 10, // USD hoặc VND được cài đặt ở /src/config/config.php
    'itemQty' => (INT) 1,
    'itemSubtotalAmount' => (FLOAT) 10 // USD hoặc VND được cài đặt ở /src/config/config.php
  ];

  /*
  *   @example third item
  */
  $transaction['items'][] = [
    'itemDescription' => 'Sản Phẩm 03',
    'itemPrice' => (FLOAT) 10, // USD hoặc VND được cài đặt ở /src/config/config.php
    'itemQty' => (INT) 2,
    'itemSubtotalAmount' => (FLOAT) 20 // USD hoặc VND được cài đặt ở /src/config/config.php
  ];

  $transaction['payload'] = [
    'foo' => [
        'bar' => 'baz'
    ]
  ];

  return \CoinPayment::generatelink($transaction);
  . . . 
```

## Nhận Trạng Thái Giao Dịch

Mở file Job này `App\Jobs\CoinpaymentListener` để nhận trạng thái và tiến trình giao dịch đơn hàng

## Kiểm Tra Giao Dịch Thủ Công Không Cần IPN

Chức năng này sẽ thực hiện lệnh mà không cần phải đợi xử lý từ IPN

Và để chạy chức năng này mà ko cần IPN thì phải chạy CronJob

```
/**
* Đây là hàm trigger để chạy Job xử lý
*/
return \CoinPayment::getstatusbytxnid("CPDA4VUGSBHYLXXXXXXXXXXXXXXX");
/**
  Ví dụ output: "celled / Timed Out"
*/
```

## Lấy Lịch Sử Giao Dịch Eloquent
```
\CoinPayment::gettransactions()->where('status', 0)->get();
```

# IPN Route

Loại trừ đường dẫn `/coinpayment/ipn` này vào csrf proccess trong `App\Http\Middleware\VerifyCsrfToken` 
```
. . .
/**
  * Các URI cần được loại trừ khỏi xác minh CSRF.
  *
  * @var array
  */
protected $except = [
    '/coinpayment/ipn'
]; 
. . .
```
# Lỗi Tích Hợp Website Có Sẵn
## Nếu bạn không thể sử dụng đối tượng loại  Illuminate\Http\JsonResponse dưới dạng array (mảng)
Hãy truy cập vào trang [**CoinPayment API Keys**](https://www.coinpayments.net/index.php?cmd=acct_api_keys) này, ở chỗ *Actions*, nhấn vào nút *Edit Permissions*. Nhập địa chỉ IP của điểm cuối API của bạn (ví dụ: IP máy chủ trang web của bạn) vào phần *Restrict to IP/IP Range*. Đôi khi để trống chỗ cài đặt này sẽ dần tới lỗi website Laravel có sẵn.
