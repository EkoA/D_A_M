<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Department;
use App\Order;
use App\Item;

class HomeController extends Controller
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

        $role = Auth::user()->role_id;

        if($role == "BASIC")
        {
            $user = Auth::user();
            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass=="NO")
            {
                $user = Auth::user()->id;
                //return $user;
                return view('users.changepassword')->with('user', $user);
            }

            if($checkpass=="BLOCK")
            {
              Auth::logout();
              //Session::flush();
              //dd(Auth::check());
                //return view('users.changepassword')->with('user', $user);
                $msg = "You have been blocked Please see Human Capital";
                $cookie_name = "cooks";
                //$_SESSION["msg"] = "You have been blocked Please see Human Capital";
                setcookie($cookie_name, $msg, time() + (86400 * 30), "/");
                return redirect('/logout');
            }
            return view('orders.create')->with('user', $user);
        }

        if($role == "HOF")
        {
            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass=="NO")
            {
                $user = Auth::user()->id;
                //return $user;
                return view('users.changepassword')->with('user', $user);
            }

            $corders = DB::table('orders')
                     ->select(DB::raw('count(*) as order_count'))
                     ->where('admin_approval', 'PENDING')->where('hod_approval', 'APPROVED')->where('finance_approval', 'PENDING')
                     ->get();

            $citems = DB::table('items')
                     ->select(DB::raw('count(*) as item_count'))
                     ->where('asset_approval', 'APPROVED')
                     ->where('disposal_status', 'AVAILABLE')
                     ->get();

                     $itemsco = DB::table('items')
                              ->where('asset_approval', 'APPROVED')->where('disposal_status', '=', 'AVAILABLE')
                              ->sum('amount');

                              $itemsva = DB::table('items')
                                       ->where('asset_approval', 'APPROVED')->where('disposal_status', '=', 'AVAILABLE')
                                       ->sum('current_value');

            $caorders = DB::table('orders')
                     ->select(DB::raw('count(*) as aorder_count'))
                     ->where('admin_approval', 'APPROVED')
                     ->get();

                     $departments = Department::all();
                     $list_depart = [];
                     foreach ($departments as $dept)
                     {
                       $depart = Item::select([
                         'id', 'asset_number', 'item', 'department','amount'
                       ])->where('department', $dept->dept_name)->where('asset_approval', 'APPROVED')->where('disposal_status', 'AVAILABLE')
                       ->sum('amount');

                       /*$keys = $depart;
                       $a = array_fill_keys($keys, "$dept->dept_name");*/
                       $list_depart[] = $depart;
                     }

            $orders = DB::table('orders')->where('admin_approval', 'PENDING')->where('hod_approval', 'APPROVED')->where('finance_approval', 'PENDING')->get();

            return view('finances.index', ['corders' => $corders, 'items' => $citems, 'caorders' => $caorders, 'cost' => $itemsco, 'val' => $itemsva, 'orders' => $orders, 'depart'=> $list_depart, 'department'=>$departments]);
        }

        if($role == "HOD")
        {
            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass=="NO")
            {
                $user = Auth::user()->id;
                //return $user;
                return view('users.changepassword')->with('user', $user);
            }

            $dept = Auth::user()->department;

                    $orders = DB::table('orders')->where('department', $dept)->get();

                    return view('departments.index', ['orders' => $orders]);
        }

        if($role == "ADMIN")
        {
          //dd($role);
            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass=="NO")
            {
                $user = Auth::user()->id;
                //return $user;
                return view('users.changepassword')->with('user', $user);
            }

            $users = User::all();

            $corders = DB::table('orders')
                     ->select(DB::raw('count(*) as order_count'))
                     ->where('admin_approval', 'PENDING')->where('hod_approval', 'APPROVED')->where('finance_approval', 'APPROVED')
                     ->get();

                     $citems = DB::table('items')
                              ->select(DB::raw('count(*) as item_count'))
                              ->where('asset_approval', 'APPROVED')
                              ->where('disposal_status', 'AVAILABLE')
                              ->get();

            $cuser = DB::table('users')
                     ->select(DB::raw('count(*) as user_count'))
                     ->get();

            $orders = DB::table('orders')->where('admin_approval', 'PENDING')->where('finance_approval', 'APPROVED')->get();

            $itemsco = DB::table('items')
                     ->where('asset_approval', 'APPROVED')->where('disposal_status', '=', 'AVAILABLE')
                     ->sum('amount');

            return view('home', ['users' => $users,'torders' => $orders, 'orders' => $corders, 'items' => $citems, 'uzer' => $cuser, 'cost' => $itemsco]);
        }
        /*$checkpass = Auth::user()->account_activated;
        //return $checkpass;
        if($checkpass!="YES")
        {
            $user = Auth::user()->id;
            return view('users.changepassword')->with('user', $user);
        }

        return view('home');*/
    }
}
