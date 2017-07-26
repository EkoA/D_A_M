<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use App\User;
use App\Order;
use DB;
use Auth;
use Mail;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOD")
        {
            return view('errors.404');
        }

        $dept = Auth::user()->department;

        $orders = DB::table('orders')->where('department', $dept)->get();

        return view('departments.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('departments.create')->with('user', $user);
    }

    public function deptcreate()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
            return view('errors.404');
        }

        $user = Auth::user();
        $depts = Department::all();
        return view('departments.deptcreate', ['departments'=> $depts, 'user'=> $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
            return view('errors.404');
        }

        $department = new department;
        $department->dept_name=$request->dept_name;
        $department->short_code=strtoupper($request->short_code);
        $department->created_by=$request->created_by;

        $department->save();
        return redirect()->route('departments.deptcreate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOD")
        {
            return view('errors.404');
        }

        $order = Order::find($id);
        return view('departments.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOD")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        return view('departments.edit', compact('order', $order));
    }

    public function decline($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOD")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        return view('departments.decline', compact('order', $order));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOD")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        $order->quantity=$request->quantity;
        $order->comment=$request->comment;
        $order->hod_approval=$request->hod_approval;


        $pers = DB::table('users')->where('role_id', 'HOF')->first();


        $this->sendEmailReminder($pers->email, $pers->name);

        $order->save();

        return redirect()->route('departments.pending');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function pending()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        //checking user role
        $check = Auth::user()->role_id;
        if($check!="HOD")
        {
            return view('errors.404');
        }

        $dept = Auth::user()->department;

        $orders = DB::table('orders')->where('department', $dept)->where('hod_approval', 'PENDING')->where('admin_approval', 'PENDING')->get();

        return view('departments.pending', ['orders' => $orders]);
    }

    public function destroy($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        //checking user role
        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
            return view('errors.404');
        }
        //dd($id);
        Department::destroy($id);
        return redirect()->route('departments.deptcreate');
    }

    public function sendEmailReminder($email, $name)
    {
        //$user = User::findOrFail($id);
        //$msg = $name;

        Mail::send(['text' => 'emails.pending'], ['name' => $name], function ($m) use($email, $name){
            $m->from('postmaster@dams.dreammesh.ng', 'DAMs Admin');

            $m->to($email, $name)->subject('Pending Request');
        });
    }

}
