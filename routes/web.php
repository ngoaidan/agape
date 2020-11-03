<?php

use App\Jobs\PushNotificationJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment('production', 'staging')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('customers/publish','Voyager\CustomerController@publish')->name('customers.publish');
    Route::get('supports/publish','Voyager\SupportController@publish')->name('supports.publish');
    Route::post('orders/updated','Admin\OrderProductController@updated')->name('orders.updated');
    Route::post('order-services/updated','Admin\OrderServiceController@updated')->name('order-services.updated');

    Voyager::routes();
});


Route::get('test', function (){
    $deviceTokens = \App\Models\Customer::whereNotNull('device_token')->get('device_token')->pluck('device_token');
    $notify = \App\Models\Notification::create(
        [
            'topic' => 'promotion',
            'title' => 'Chương trình khuyến mãi',
            'body' => 'Chúc mừng bạn đã nhận được thẻ quà tặng',
        ]
    );

    PushNotificationJob::dispatch('sendBatchNotification', [
        $deviceTokens,
        [
            'topicName' => $notify->topic,
            'title' => $notify->title,
            'body' => $notify->body,
        ],
    ]);
//    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
//    $token="AAAAa7RuZFw:APA91bGiI56tV6PQRLWuFv-prl2ngrsFQzwEzvExZTJ4s8MQ0RGx_Rpstz1ugUYxD1KJcaMLxwcYZfNTw_rWZKLezMrGIqhN9N87-3M-4plnJNPKQYtCOIPB2FDmpSUgWDPkpAQdhhqr";
//
//
//    $notification = [
//        'body' => 'this is test',
//        'sound' => true,
//    ];
//
//    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
//
//    $fcmNotification = [
//        //'registration_ids' => $tokenList, //multple token array
//        'to'        => $token, //single token
//        'notification' => $notification,
//        'data' => $extraNotificationData
//    ];
//
//    $headers = [
//        'Authorization: key=Legacy server key',
//        'Content-Type: application/json'
//    ];
//
//
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
//    curl_setopt($ch, CURLOPT_POST, true);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
//    $result = curl_exec($ch);
//    curl_close($ch);
//
//
//    return $result;

});
