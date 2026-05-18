<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::query()->count('id');
        $totalOrders = Order::query()->count('id');
        $totalUsers = User::query()->count('id');
        $recentOrders = Order::query()->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalUsers', 'recentOrders'));
    }
}
