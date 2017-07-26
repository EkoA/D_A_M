<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use DB;
use App\Order;

class BasicController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest())
        {
           return view('auth.login'); 
        }

    	$checkpass = Auth::user()->account_activated;
        //return $checkpass;
        if($checkpass!="YES")
        {
            $user = Auth::user()->id;
            return view('users.changepassword')->with('user', $user);
        }

        return view('orders.create');
    }


    /*
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sent()
    {
        if (Auth::guest())
        {
           return view('auth.login'); 
        }

    	//checking user role 
        $user = Auth::user()->name;

        $orders = DB::table('orders')->where('made_by', $user)->get();

        return view('basic.sent', ['orders' => $orders]);
    }


    public function show($id)
    {
        if (Auth::guest())
        {
           return view('auth.login'); 
        }

        //checking user role 
        $user = Auth::user()->name;

        $order = Order::find($id);

        return view('basic.show')->with('order', $order);
    }


}
