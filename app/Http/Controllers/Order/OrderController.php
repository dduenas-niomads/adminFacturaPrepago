<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (Auth::user()) {
            $view = view('orders.orders');
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function edit($id)
    {
        if (Auth::user()) {
            dd($id);
        } else {
            $view = view('errors.403');
        }
        return $view;
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        dd($id, $params);
    }
}
