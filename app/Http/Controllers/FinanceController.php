<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;
use Auth;
use App\Department;
use App\Order;
use App\Item;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Mail;
use Excel;

class FinanceController extends Controller
{
    public function index()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        //$orders = Order::all();

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
                              //->first();

                              $itemsva = DB::table('items')
                                       ->where('asset_approval', 'APPROVED')->where('disposal_status', '=', 'AVAILABLE')
                                       ->sum('current_value');

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
                    //dd($a);

        $orders = DB::table('orders')->where('admin_approval', 'PENDING')->where('hod_approval', 'APPROVED')->where('finance_approval', 'PENDING')->orderBy('id', 'desc')->get();

        return view('finances.index', ['corders' => $corders, 'items' => $citems, 'cost' => $itemsco, 'val' => $itemsva, 'orders' => $orders, 'depart'=> $list_depart, 'department'=>$departments]);
    }

     /**
     * Display the specified resource      *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //checking user role
        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        $order = Order::find($id);
        return view('finances.show')->with('order', $order);
    }

    public function pending()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //checking user role
        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        $orders = DB::table('orders')->where('admin_approval', 'PENDING')->where('hod_approval', 'APPROVED')->where('finance_approval', 'PENDING')->orderBy('id', 'desc')->paginate(10);

        return view('finances.pending', ['orders' => $orders]);
    }

    public function approved()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //checking user role
        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        $orders = DB::table('orders')->where('admin_approval', 'APPROVED')->orderBy('id', 'desc')->paginate(10);

        //$orders = Order::

        return view('finances.approved', ['orders' => $orders]);
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

        //checking user role
        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        return view('finances.edit', compact('order', $order));
    }

    public function update(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        $order->comment=$request->comment;
        $order->finance_approval=$request->finance_approval;


        $pers = DB::table('users')->where('role_id', 'ADMIN')->first();

        //$this->sendEmailReminder($pers->email, $pers->name);

        $order->save();

        return redirect()->route('finances.pending');
    }

    public function decline($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $check = Auth::user()->role_id;
        if($check!="HOF")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        return view('finances.decline', compact('order', $order));
    }

    public function order()
    {
        $user = Auth::user();

        return view('finances.order')->with('user', $user);
    }

    public function generateReport(Request $request)
    {
      $dat = date("d-m-Y");

      $orders = Order::select(['id', 'order_item', 'description', 'quantity', 'cost', 'admin_approval', 'finance_approval', 'hod_approval', 'department',
                'made_by', 'created_at'])->where('admin_approval', 'APPROVED')->get();
      //dd($orders);
      $orders = json_decode($orders, true);
      //$orders = collect($orders[0]);

      //$reporttype = $request->report_type;

          Excel::create("DAMsOrderReport_$dat", function($excel) use($orders)
          {
            $excel->sheet('Sheetname', function($sheet) use($orders)
            {
                $sheet->fromArray($orders, null, 'A1', false, false)->prependRow([
                  'ID', 'Item', 'Item Description', 'Quantity', 'Amount', 'MD Approval', 'Finance Approval', 'H.O.D Approval', 'Department',
                  'Inititator', 'Date'
                ]);
            });

          })->export('xls');
    }

    public function sendEmailReminder($email, $name)
    {
      Mail::send('emails.pending', ['name' => $name], function ($message) use ($email){
        $message->from('us@example.com', 'Laravel');
        $message->to($email, 'User')->subject('Pending Request (DO-NOT-REPLY-THIS-EMAIL)');
      });

        /*Mailgun::send('emails.welcome', $data, function ($message) {
            $message->to('foo@example.com', 'John Smith')->subject('Welcome!');
        });*/

        //$user = User::findOrFail($id);
        //$msg = $name;

       /*Mailgun::send(['text' => 'emails.pending'], ['name' => $name], function ($m) use($email, $name){
            $m->from('postmaster@dams.dreammesh.ng', 'DAMs Admin');
            $m->to($email, $name)->subject('Pending Request');
        });*/
    }

}
