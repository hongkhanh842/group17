<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ApiDashboardController extends Controller
{
    use ResponseTrait;

    public function all()
    {
        $arr['new'] = Order::where('status', 'Mới')->whereMonth('created_at', date('m'))->count();
        $arr['accepted'] = Order::where('status', 'Đã xác nhận')->whereMonth('created_at', date('m'))->count();
        $arr['shipping'] = Order::where('status', 'Đang giao')->whereMonth('created_at', date('m'))->count();
        $arr['shipped'] = Order::where('status', 'Đã giao')->whereMonth('created_at', date('m'))->count();
        $arr['cancel'] = Order::where('status', 'Huỷ')->whereMonth('created_at', date('m'))->count();
        $arr['total'] = Order::whereMonth('created_at', date('m'))->count();
        $arr['users'] = User::where('role','1')->count();
        $arr['categories'] = Category::count();
        $arr['products'] = Product::count();
        $arr['month'] = date('m');

        return $this->successResponse($arr);
    }
}
