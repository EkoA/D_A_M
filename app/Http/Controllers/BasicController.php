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
        
        $dept = Auth::user()->department;
        
        $hod = DB::table('users')->where('role_id', 'HOD')->where('department', $dept)->first();
        
        if(empty($hod))
        {
            $hd = "FALSE";
        }
        else
        {
            $hd = "TRUE";
        }
        
        return view('basic.show', ['order'=>$order, 'hd'=>$hd]);
    }
    
    public function edit($id)
    {
        if (Auth::guest())
        {
           return view('auth.login'); 
        }
        
        $order = Order::find($id);
        
        $dept = Auth::user()->department;
        
        $hod = DB::table('users')->where('role_id', 'HOD')->where('department', $dept)->first();
        
        if(empty($hod))
        {
            $hd = "FALSE";
        }
        else
        {
            $hd = "TRUE";
        }
        
        return view('basic.edit', ['order'=>$order, 'hd'=>$hd]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $order = Order::find($id);

        $order->order_item=$request->order_item;
        $order->description=$request->description;
        $order->cost=$request->cost;
        $order->quantity=$request->quantity;

        $order->save();
        
        $user = Auth::user()->name;
        
        $dept = Auth::user()->department;

        $order = Order::find($id);
        
        $hod = DB::table('users')->where('role_id', 'HOD')->where('department', $dept)->first();
        
        if(empty($hod))
        {
            $hd = "FALSE";
        }
        else
        {
            $hd = "TRUE";
        }

        return view('basic.show', ['order' => $order, 'hd'=>$hd]);
    }

}
