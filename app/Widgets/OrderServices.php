<?php

namespace App\Widgets;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class OrderServices extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = OrderService::where('status',OrderService::STATUS_NEW)->count();
        $string = 'New Order Services';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-polaroid',
            'title'  => "{$count} {$string}",
            'text'   =>'You have '.$count.' new order services. Click on button below to view '.$string.'',
            'button' => [
                'text' =>'New Order Services',
                'link' =>('/admin/order-services?status=2'),
            ],
            'image' => '/images/order-service-bg.jpg',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
