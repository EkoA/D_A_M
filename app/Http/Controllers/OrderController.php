<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use DB;
use Auth;
use App\User;
use App\Item;
use App\Classification;
use App\Department;
use Mail;
use Excel;


class OrderController extends Controller
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

        //checking user role
        $user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('errors.404');
        }

       $orders = Order::orderBy('id', 'desc')->paginate(10);

       return view('orders.index')->with('orders', $orders);
    }

    public function create()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //checking user role
        $user = Auth::user();

        //return view('orders.create')->with('user', $user);

        $orders = DB::table('orders')->distinct()->get(['id','order_item','description']);

        //$pers = DB::table('users')->where('name', $order->made_by)->first();

        //return "Eko";

        //return $orders;
        //return view('orders.create')->with('user', $user);

        return view('orders.create', ['user' => $user, 'orders' => $orders]);

        //return view('orders.sent', ['orders' => $orders]);
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

        //checking user role
        $user = Auth::user()->role_id;
        if($user == "ADMIN")
        {
            return view('errors.404');
        }

        $order = new order;
        $order->order_item = $request->order_item;
        $order->description = $request->description;
        $order->quantity = $request->quantity;
        $order->cost = $request->cost;
        $order->admin_approval = $request->admin_approval;
        $order->finance_approval = $request->finance_approval;
        $order->hod_approval = $request->hod_approval;
        $order->made_by = $request->made_by;
        $order->department = $request->department;
        $response = "Successfully Requested";

        //$porder = Order::find($id);
        //$pers = DB::table('orders')->select('department')->where('made_by', $order->made_by)->where('made_by', $order->made_by)->first();
        //return $pers->department;

        $hod = DB::table('users')->where('role_id', 'HOD')->where('department', $order->department)->where('account_activated', 'YES')->first();

        //$hpp = DB::table('users')->select('name')->where('role_id', 'HOD')->where('department', $pers->department)->first();
        /*$email = $hod->email;
        $name = ;*/

        $user = Auth::user()->role_id;

        if($user == "BASIC")
        {
    		  $depz = Auth::user()->department;
    		  if($depz == 'FINANCE')
    		  {
    			        $order->hod_approval = "APPROVED";
                  $order->save();
                  $hof = DB::table('users')->where('role_id', 'HOF')->first();
                  //$this->sendEmailReminder($hof->email, $hof->name);
                  return redirect()->route('orders.create', ['res' => $response]);
    		  }
    		  else
    		  {
    			  if(!empty($hod))
    			  {
    				  $order->save();
    				  ////$this->sendEmailReminder($hod->email, $hod->name);
    				  return redirect()->route('orders.create', ['res' => $response]);
    			  }
    			  else
    			  {
    				  $order->hod_approval = "APPROVED";
    				  $order->save();
    				  $hof = DB::table('users')->where('role_id', 'HOF')->first();
    				  //$this->sendEmailReminder($hof->email, $hof->name);
    				  return redirect()->route('orders.create', ['res' => $response]);
    			  }
    		  }
        }

        if($user == "HOD")
        {
            $hof = DB::table('users')->where('role_id', 'HOF')->first();
            //$this->sendEmailReminder($hof->email, $hof->name);
            $order->save();
            return redirect()->route('departments.create', ['res' => $response]);
        }

        if($user == "HOF")
        {
            $admin = DB::table('users')->where('role_id', 'ADMIN')->first();
            //$this->sendEmailReminder($admin->email, $admin->name);
            $order->save();
            return redirect()->route('finances.order', ['res' => $response]);
        }

        /* edit the destination
        if($user == "ADMIN")
        {
            return redirect()->route('orders.create', ['res' => $response]);
        }
        */
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
        $user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        $dept = Auth::user()->department;

        $hod = DB::table('users')->where('role_id', 'HOD')->where('department', $dept)->first();

        //dd("$hod");

        return view('orders.show', ['order'=>$order]);
    }

    public function orderdecision(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user == "BASIC")
        {
            return view('errors.404');
        }

        $order = Order::find($id);

        $response = $request->request_approval;

          if($user == "ADMIN")
          {
            //return $request->quantity;
            $order->quantity = $request->quantity;
            $order->cost = $request->cost * $request->quantity;
            $order->admin_approval = $response;

            if($response == "APPROVED")
            {
              if($order->finance_approval == "PENDING")
              {
                if($order->hod_approval == "PENDING")
                {
                  $order->comment = $request->comment;
                  $order->hod_approval = "N/A";
                  $order->save();
                }
                $order->comment = $request->comment;
                $order->finance_approval = "N/A";
                $order->save();
              }
              else
              {
                $order->comment = $request->comment;
                $order->save();
              }

              $pers = DB::table('users')->where('name', $order->made_by)->first();
              //$this->sendEmailAttend($pers->email, $pers->name, $id);

              $hof = DB::table('users')->where('role_id', 'HOF')->first();

              //$this->sendEmailApproved($hof->email, $hof->name, $id);
            }
            else
            {
              $order->comment = $request->comment;
              $order->save();
              $pers = DB::table('users')->where('name', $order->made_by)->first();
              //$this->sendEmailAttend($pers->email, $pers->name, $id);
            }
            return redirect()->route('orders.pending');
          }

          if($user == "HOF")
          {
            $order->finance_approval = $response;
            $order->save();
            if($response == "APPROVED")
            {
              $pers = DB::table('users')->where('role_id', 'ADMIN')->first();
              //$this->sendEmailReminder($pers->email, $pers->name);
            }
            else
            {
              $pers = DB::table('users')->where('name', $order->made_by)->first();
              //$this->sendEmailAttend($pers->email, $pers->name);
            }
            return redirect()->route('finances.pending');
          }

          if($user == "HOD")
          {
            $order->hod_approval = $response;
            $order->save();
            if($response == "APPROVED")
            {
              $pers = DB::table('users')->where('role_id', 'HOF')->first();
              //$this->sendEmailReminder($pers->email, $pers->name);
            }
            else
            {
              $pers = DB::table('users')->where('name', $order->made_by)->first();
              //$this->sendEmailAttend($pers->email, $pers->name);
            }
            return redirect()->route('departments.pending');
          }
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
        /*$user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('errors.404');
        }*/

        $order = Order::find($id);
        $user = Auth::user();
        $orders = DB::table('orders')->distinct()->get(['id','order_item','description']);

        return view('orders.edit', ['user' => $user, 'order' => $order, 'orders' => $orders]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
                //checking user role
        /*$user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('auth.login');
        }*/

        $order = Order::find($id);

        $order->order_item=$request->order_item;
        $order->description=$request->description;
        $order->department=$request->department;
        $order->quantity=$request->quantity;
        $order->admin_approval=$request->admin_approval;

        $pers = DB::table('users')->where('name', $order->made_by)->first();
                //DB::table('table_name')->distinct()->get(['column_name']);

        //$this->sendEmailAttend($pers->email, $pers->name, $id);

        $order->save();

        return redirect()->route('orders.create');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
                //checking user role
        $user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('errors.404');
        }

        Order::destroy($id);
        return redirect()->route('orders.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
                //checking user role
        $user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('errors.404');
        }

        $orders = DB::table('orders')->where('admin_approval', 'PENDING')->where('finance_approval', 'APPROVED')->orderBy('id', 'desc')->paginate(10);

        return view('orders.pending', ['orders' => $orders]);
    }

    public function reports()
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }

      $user = Auth::user()->role_id;
      $userd = Auth::user()->department;
      if($user == "BASIC" && $userd != "FINANCE")
      {
          return view('errors.404');
      }

      $classifications = Classification::all();

      $departments = Department::all();

      return view('orders.reports', ['classifications'=>$classifications, 'departments'=>$departments]);
    }

    public function reportgen(Request $request)
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }

      $user = Auth::user()->role_id;
      $userd = Auth::user()->department;
      if($user == "BASIC" && $userd != "FINANCE")
      {
          return view('errors.404');
      }

      //dd($request->purchase_date);
        //dd($request->department);
      if(!empty($request->department)){
      $department = $request->department;
      }else { $department = "";}

      //dd($department);

      if(!empty($request->amount_from)){
      $amountfrom = $request->amount_from;
      }else { $amountfrom = "";}

      if(!empty($request->amount_to)){
      $amountto = $request->amount_to;
      }else { $amountto = "";}

      if(!empty($request->purchase_date_from)){
      $datefrom = $request->purchase_date_from;
      }else{ $datefrom = "";}

      if(!empty($request->purchase_date_to)){
      $dateto = $request->purchase_date_to;
      }else{ $dateto = "";}

      $orders = Order::select([
        'order_item', 'quantity', 'department', 'made_by', 'hod_approval', 'finance_approval', 'admin_approval', 'cost', 'created_at'
      ]);
                    if(!empty($department) && $department != "None"){
                    $orders = $orders->where('department', "$department");
                    }
                    if(!empty($amountfrom) && !empty($amountto)){
                    $orders = $orders->whereBetween('cost', ["$amountfrom", "$amountto"]);
                    }
                    if(!empty($datefrom) && !empty($dateto)){
                    $orders = $orders->whereBetween('created_at', ["$datefrom", "$dateto"]);
                    //dd($dateto);
                    }
                    /*->whereBetween('amount', [$amountfrom, $amountto])
                    ->whereBetween('depreciation', [$deprefrom, $depreto])
                    ->get();*/
      $orders = $orders->get();


      if(empty($orders[0]))
      {
        $msg = "No result for parameters set";
        $classifications = Classification::all();
        $departments = Department::all();
        return view('orders.reports', ['msg' => $msg, 'classifications'=>$classifications, 'departments'=>$departments]);
      }

      $dat = date("d-m-Y");

      //$items = $request->report_details;
      //dd($items);
      $orders = json_decode($orders, true);
      //$items = collect($items[0]);
      //$reporttype = $request->report_type;

          Excel::create("DAMsRequestReport_$dat", function($excel) use($orders)
          {
            $excel->sheet('Sheetname', function($sheet) use($orders)
            {
                $sheet->fromArray($orders, null, 'A1', false, false)->prependRow([
                  'Item', 'Quantity', 'Department', 'Initiator', 'H.O.D Approval', 'Finance Approval', 'MD Approval', 'Amount(Per item)', 'Date Requested'
                ]);
                /*foreach($sheet->rows as $row){
                $row->appendCell('Some custom data');
                }*/
            });
          })->export('xls');
    }

    public function sent()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
                //checking user role
        $user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('errors.404');
        }

        $orders = DB::table('orders')->where('department', 'Software Development')->orderBy('id', 'desc')->paginate(10);

        return view('orders.sent', ['orders' => $orders]);

        /*$orders = Order::all();
        return view('orders.index')->with('orders', $orders);*/
    }

    public function declineview($id)
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }
              //checking user role
      $user = Auth::user()->role_id;
      if($user!="ADMIN")
      {
          return view('errors.404');
      }

      return view('');
    }

    public function search(Request $request)
    {
      //return "Hello";
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //checking user role
        $user = Auth::user()->role_id;
        if($user!="ADMIN" && $user!="HOF")
        {
            return view('errors.404');
        }

        // search
        $ords = null;
        if($request->has('search')&&($request->get('search')!=null))
        {
            $search = $request->get('search');
            $ords=Order::where('id','like','%'.$search.'%')
                            ->orWhere('order_item', 'like', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        }
        else
        {
            $ords = Order::paginate(20);
        }

        return view('orders.search',compact('ords', $ords));
    }

    public function sendEmailReminder($email, $name)
    {
        //$user = User::findOrFail($id);
        //$msg = $name;
        Mail::send('emails.pending', ['name' => $name], function ($m) use($email, $name){
            $m->to($email, $name)->subject('Pending Request (DO-NOT-REPLY-THIS-EMAIL)');
        });
    }

    public function sendEmailAttend($email, $name, $id)
    {
        //$user = User::findOrFail($id);
        //$msg = $name;
        Mail::send('emails.attended', ['name' => $name, 'id' => $id], function ($m) use($email, $name){
            $m->to($email, $name)->subject('DAMS Request (DO-NOT-REPLY-THIS-EMAIL)');
        });
    }

    public function sendEmailApproved($email, $name, $id)
    {
        //$user = User::findOrFail($id);
        //$msg = $name;
        Mail::send('emails.approved', ['name' => $name, 'id' => $id], function ($m) use($email, $name){
            $m->to($email, $name)->subject('DAMS Request (DO-NOT-REPLY-THIS-EMAIL)');
        });
    }

}
