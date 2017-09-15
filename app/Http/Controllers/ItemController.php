<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Validator;
use App\Item;
use DB;
use Auth;
use App\User;
use App\Classification;
use App\Department;
use App\Depreciation;
use Mail;
use Excel;

class ItemController extends Controller
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

        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        $items = Item::select([
          'id', 'asset_number', 'serialno', 'invoice_number', 'item', 'department', 'location', 'classification', 'supplier_details',
          'description', 'amount', 'economiclife', 'current_value', 'purchase_date', 'asset_approval',
          'created_by', 'created_at'
        ])->where('asset_approval', 'APPROVED')->where('disposal_status', 'AVAILABLE')->get();

        return view('items.index', ['items'=> $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $userr = Auth::user();

        $classifications = Classification::all();

        $departments = Department::all();

        return view('items.create', ['classifications'=>$classifications, 'user' => $userr, 'departments'=>$departments]);
    }

    public function generateReport(Request $request)
    {
      $dat = date("d-m-Y");

      $items = $request->report_details;
      //dd($items);
      $items = json_decode($items, true);
      //$items = collect($items[0]);

      //$reporttype = $request->report_type;

          Excel::create("DAMsReport_$dat", function($excel) use($items)
          {
            $excel->sheet('Sheetname', function($sheet) use($items)
            {
                $sheet->fromArray($items, null, 'A1', false, false)->prependRow([
                  'ID', 'Asset Number', 'Serial Number', 'Invoice Number', 'Item', 'Department', 'Location', 'Classification', 'Supplier Details',
                  'Description', 'Amount', 'Economic Life', 'NBV', 'Purchase Date', 'Asset Approval',
                  'Registered by', 'Registered on'
                ]);
            });

          })->export('xls');
    }

    protected function generateSerial($classification, $department, $id)
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

        $class = DB::table('classifications')->where('class_name', $classification)->value('short_code');

        $dept = DB::table('departments')->where('dept_name', $department)->value('short_code');

        if($id <= 9)
        {
            $id = "000". $id;
        }

        if($id > 9 && $id <= 99)
        {
            $id = "00". $id;
        }

        if($id > 99 && $id <= 999)
        {
            $id = "0". $id;
        }

        $genser = "DM" ."/". $class ."/". $dept ."/". $id;
        return $genser;
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

        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        $item = Item::find($id);

        /*$asset = Item::find($id)->asset_number;

        if($asset = "None")
        {
            $classi = Item::find($id)->classification;
            $depti = Item::find($id)->department;

            $gense = $this->generateSerial($classi, $depti, $id);

            $item->asset_number = $gense;

            $item->save();

            return view('items.show')->with('item', $item);
        }*/

        /*$date1 = date("Y-m-31");
        $date2 = $item->purchase_date;

        if($date1 > $date2)
        {
          return $date1 - $date2;
        }*/

        return view('items.show', ['user'=> $user, 'item'=>$item]);
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

        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        $item = Item::find($id);

        $classifications = Classification::all();

        $departments = Department::all();

        return view('items.edit', ['classifications' => $classifications, 'item' => $item, 'departments'=> $departments]);
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

        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        $item = Item::find($id);

        $item->item = $request->item;
        $item->invoice_number = $request->invoice_number;
        if(empty($request->serialno))
        {
            $item->serialno = "N/A";
        }
        else
        {
            $item->serialno = $request->serialno;
        }
        $item->location = $request->location;
        $item->classification = $request->classification;
        $item->supplier_details = $request->supplier_details;
        $item->description = $request->description;
        $item->department = $request->department;
        $item->amount = $request->amount;
        $item->purchase_date = $request->purchase_date;
        $item->economiclife = $request->economiclife;
        $item->isdepreciate = $request->isdepreciate;
        $item->asset_approval = $request->asset_approval;
        if($request->isdepreciate == "No")
        {
          $item->depreciationformula= "None";
        }
        else
        {
          $item->depreciationformula = $request->depreciationformula;
        }

        $item->save();

        $user = Auth::user()->role_id;
        if($user == "ADMIN")
        {
            return redirect()->route('asset.index');
        }
        return redirect()->route('items.index');
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

        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        //usering user role
        /*$user = Auth::user()->role_id;
        if($user!="ADMIN")
        {
            return view('auth.login');
        }*/

        Item::destroy($id);
        return redirect()->route('items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        return view('items.order');
    }

    public function search(Request $req)
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

        $items = null;
        if($req->has('search')&&($req->get('search')!=null))
        {
            $search = $req->get('search');
            $items=Item::where('asset_approval', '=', 'APPROVED')
                            ->where('disposal_status', '=', 'AVAILABLE')
                            ->where(function($query) use ($search) {
                                $query->where('id','like','%'.$search.'%')
                                ->orWhere('asset_number', 'like', '%'.$search.'%')
                                ->orWhere('item', 'like', '%'.$search.'%')
                                ->orWhere('department', 'like', '%'.$search.'%')
                                ->orWhere('classification', 'like', '%'.$search.'%');
                              })
                            ->OrderBy('id')->get();
                            //->paginate(10);
        }
        else
        {
            $items = Item::paginate(20);
        }

      return view('finances.search',['items' => $items]);
    }

    public function depreciate()
    {
      //return "Eko";
      $dat = date("m");
      $daty = date("Y");
      //$dat = "03";
      $items=Item::where('asset_approval', '=', 'APPROVED')
                 ->where('disposal_status', '=', 'AVAILABLE')
                 ->where('current_value', '>', 0)
                 ->where('purchase_date', 'like', '_____'.$dat.'%')
                 ->where('purchase_date', 'NOT LIKE', $daty.'%')->get();

        //$itemd = $items->depreciationformula;
        $items = json_decode($items, true);
        if(!empty($items))
        {
          foreach ($items as $v)
          {
            foreach ($v as $key => $val)
            {
              //return "$key: $val";
              if($key == "id")
              {
                $id = $val;
              }
              if($key == "amount")
              {
                $cost = $val;
              }
              if($key == "economiclife")
              {
                $el = $val;
              }
              if($key == "residual_value")
              {
                $rv = $val;
              }
              if($key == "rate")
              {
                $rate = $val;
                //dd("Hello");
              }
              if($key == "current_value")
              {
                $nbv = $val;
              }
              if($key == "current_year")
              {
                $cy = $val;
              }
              if($key == "depreciationformula")
              {
                //return "$val";
                  if($val == "STRAIGHT LINE METHOD")
                  {
                    $depri = ($cost - $rv) / $el;
                    //dd($nbv);
                    if($cost == $nbv)
                    {
                      $newval = ($cost - $rv) - $depri;
                    }
                    else
                    {
                      $newval = $nbv - $depri;
                    }
                    $item = Item::find($id);
                    $accum = $item->depreciation;
                    $item->depreciation = $depri;
                    $totalaccum = $accum + $depri;
                    $item->accumulated = $totalaccum;
                    $item->current_value = $newval;
                    $item->save();
                  }
                  elseif ($val == "REDUCING BALANCE METHOD")
                  {
                    $depri = ($nbv - $rv) * $rate;
                    $newval = $nbv - $depri;
                    $item = Item::find($id);
                    $item->current_value = $newval;
                    $item->depreciation = $depri;
                    $item->accumulated += $depri;
                    $item->save();
                  }
                  elseif ($val == "SUM OF YEAR METHOD")
                  {
                    //$depribase is short for depreciable base
                     $num = $el * ($el + 1);
                     $depri = $num / 2;
                     $depribase = $cost - $rv;
                     $newval = ($cy/$depri) * $depribase;

                     $item = Item::find($id);

                     $item->depreciation = $newval;
                     $item->accumulated += $newval;

                     $dep = Depreciation::find($id);

                     if($item->current_year == $dep->year)
                     {
                       //send email here
                     }
                     else
                     {
                       if ($dep->current_year == "0")
                       {
                         $dep->year = 1;
                         $dep->save();
                       }
                       else
                       {
                         $dep->year += 1;
                         $dep->save();
                       }

                     $yearupdate = $cy - 1;
                     $item->current_year = $yearupdate;
                     $item->save();
                   }
                  }
                }
              }
            }
          }
    }

    public function classification(Request $req)
    {
       if (Auth::guest())
        {
           return view('auth.login');
        }
                //checking user role
        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        /*$office = DB::table('items')->where('classification', 'Office Equipment')->get();
        $plant = DB::table('items')->where('classification', 'Plant & Machinery')->get();
        $furni = DB::table('items')->where('classification', 'Furniture & Fittings')->get();*/

        $classifications = Classification::all();

        return view('items.classification', ['classifications' => $classifications]);

        //return view('items.classification', ['office' => $office, 'plant' => $plant, 'furni' => $furni]);
    }

	  public function dispose($id)
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

	     $item = Item::find($id);

      return view('items.dispose', ['user'=> $user, 'item'=>$item]);
    }

    public function disposal(Request $request, $id)
    {
      //function that handles disposal of asset by Head of Finance
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

      $item = Item::find($id);
      $item->disposal_date = $request->disposal_date;
      $item->disposal_status = $request->disposal_status;
      $item->sales_invoice = $request->sales_invoice;
      $item->agreed_price = $request->agreed_price;
      $item->further_info = $request->further_info;
      $item->save();

        $items = Item::select([
          'id', 'asset_number', 'serialno', 'invoice_number', 'item', 'department', 'location', 'classification', 'supplier_details',
          'description', 'amount', 'economiclife', 'isdepreciate', 'depreciationformula', 'current_value', 'purchase_date', 'asset_approval',
          'created_by', 'created_at'
        ])->where('asset_approval', 'APPROVED')->where('disposal_status', 'AVAILABLE')->get();

      //return $items;
      return view('items.index', ['items'=> $items]);
    }

    //all functions that begin with 'asset' work from the admin side
    public function masscreate()
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }

      $user = Auth::user();
      $orders = DB::table('orders')->distinct()->get(['id','order_item','description']);
      return view('items.masscreate', ['user' => $user, 'orders' => $orders]);
    }

    public function massstore(Request $request)
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }
      $fileName = 'DAMSUPLOAD'. '_' . date('Ymds') . '.' .
              $request->file('excelitem')->getClientOriginalExtension();

      		$file = $request->file('excelitem');
      		$destination_path = storage_path() .'/public/files/excel/';

      		$file->move($destination_path, $fileName);

      		$destination_path = storage_path() .'/public/files/excel/'.$fileName;

      		$response = "Nothing";
              if($request->file('excelitem'))
              {
                $path = $request->file('excelitem')->getPathName();
      			$callback = "Hello";
      			//dd($path);

      			$path = 'public/files/excel/'. $fileName;

                $data = \Excel::load($destination_path)->get();

                if($data->count())
                {
                  //dd($data);
                    foreach ($data as $key => $value)
                    {
                      //dd($value);
                        $arr[] = ['Item' => $value->item, 'Department' => $value->department, 'Location' => $value->location,
                        'Classification' => $value->classification, 'Supplier Details' => $value->supplierdetails, 'Description' => $value->description,
                        'Amount' => $value->amount, 'Economic Life' => $value->economiclife, 'NBV' => $value->nbv];
                        //dd($arr);
                          $item = new Item;
                          $item->item = $value->item;
                          $item->invoice_number = $value->invoice_number;
                          if(empty($value->serialno))
                          {
                              $item->serialno = "N/A";
                          }
                          else
                          {
                              $item->serialno = $value->serialno;
                          }
                          $item->location = $value->location;
                          $item->classification = $value->classification;
                          $item->supplier_details = $value->supplier_details;
                          $item->department = $value->department;
                          $item->description = $value->description;
                          $item->amount = $value->amount;
                          $item->purchase_date = $value->purchase_date;
                          $item->economiclife = $value->economic_life;
                          $item->current_year = $value->economic_life;
                          $item->isdepreciate = $value->isdepreciate;
                          $item->current_value = $value->amount;
                          $item->residual_value = $value->residual_value;
                          $item->disposal_status = "AVAILABLE";
                          $item->asset_approval = "PENDING";
                          $item->created_by = Auth::user()->name;
                          if($value->isdepreciate == "No")
                          {
                            $item->depreciationformula= "None";
                          }
                          else
                          {
                            $item->depreciationformula = $value->depreciationformula;

                            if( $value->depreciationformula == "REDUCING BALANCE METHOD")
                            {
                              $item->rate = $value->rate;
                            }
                            else
                            {
                              $item->rate = "0";
                            }
                          }
                          //$item->asset_number = $stuff;

                    $pers = DB::table('users')->where('role_id', 'ADMIN')->first();

                    //mail function
                    $this->sendEmailAdd($item->item, $pers->email, $item->location, $item->classification, $item->amount);

                    $item->save();

                    $item_update = Item::find($item->id);

                    $classi = $value->classification;
                    $depti = $value->department;
                    $id = $item->id;
                    $gense = $this->generateSerial($classi, $depti, $id);

                    $item_update->asset_number = $gense;

                    $item_update->save();

                    //$response ="Successfully registered assets";
                    $response ="File is Empty please try another file";
              }
              if(empty($arr))
              {

              }
              else
              {
                  $response = "Successfully registered assets";
              }
          }
       }
       else
       {
         $response = "File Not found";
       }

      //dd('Request data does not have any files to import');
      //return $response;
      if($response != "Successfully registered assets")
      {
        $response = "Error While Uploading file, Please try again";
      }
      return view('items.masscreate', ['ret' => "$response"]);
    }

    public function asset()
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

        /*$orders = DB::table('orders')->where('admin_approval', 'PENDING')->where('hod_approval', 'APPROVED')->where('finance_approval', 'PENDING')->get();

        return view('finances.pending', ['orders' => $orders]);*/
        //$items = Item::all();
        $items = DB::table('items')->where('asset_approval', 'APPROVED')->where('disposal_status', 'AVAILABLE')->get();

        return view('asset.index', ['items' => $items, 'user' => $user]);
    }

    public function assetshow($id)
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

        $item = Item::find($id);

        return view('asset.show')->with('item', $item);
    }

    public function assetcreate()
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

        $userr = Auth::user();

        $classifications = Classification::all();

        $departments = Department::all();

        return view('asset.create', ['classifications'=>$classifications, 'user' => $userr, 'departments'=>$departments]);
    }

    public function assetedit($id)
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
        $item = Item::find($id);

        $classifications = Classification::all();

        $departments = Department::all();

        return view('asset.edit', ['classifications' => $classifications, 'item' => $item, 'departments'=> $departments]);
    }

    public function assetpending()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user != "ADMIN")
        {
            return view('errors.404');
        }

        $items = DB::table('items')->where('asset_approval', 'PENDING')->get();

        return view('asset.pending', ['items'=> $items]);
    }

    public function assetdecision(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user != "ADMIN")
        {
            return view('errors.404');
        }

        //dd($request->asset_approval);

        $item = Item::find($id);

        if($request->asset_approval == "DECLINED")
        {
          Item::destroy($id);
        }

        if($request->asset_approval == "APPROVED")
        {
          $item->asset_approval = $request->asset_approval;
          $item->save();
        }
        return redirect()->route('asset.pending');
    }

    public function assetdisposal(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user != "ADMIN")
        {
            return view('errors.404');
        }

        $item = Item::find($id);

        $response = $request->asset_approval;

        if($response == "DECLINED")
        {
          $item->disposal_date = ' ';
          $item->disposal_status = 'AVAILABLE';
          $item->sales_invoice = ' ';
          $item->agreed_price = ' ';
          $item->further_info = ' ';
          $item->save();
        }

        $dat = date("Y-m-d");

        if($response == "APPROVED")
        {
          $item->disposal_status = 'DISPOSED';
          $item->disposal_date = $dat;
          $item->save();
        }

        return redirect()->route('asset.disposalpending');
    }

    public function massdecision(Request $request)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user != "ADMIN")
        {
            return view('errors.404');
        }

        $items = DB::table('items')->where('asset_approval', 'PENDING')->get();
        //dd($items);
        if($request->asset_approval == "APPROVED")
        {
            foreach ($items as $key => $value)
            {
              foreach ($value as $k => $v)
              {
                if($k == "id")
                {
                  $id = $v;
                }
                $item = Item::find($id);
                $item->asset_approval = $request->asset_approval;
                $item->save();
              }
            }
        }

        if($request->asset_approval == "DECLINED")
        {
            foreach ($items as $key => $value)
            {
              foreach ($value as $k => $v)
              {
                if($k == "id")
                {
                  $id = $v;
                }
                $item = Item::find($id);
                Item::destroy($id);
              }
            }
        }

        $item = Item::find($id);

        if($request->asset_approval == "DECLINED")
        {
          Item::destroy($id);
        }

        if($request->asset_approval == "APPROVED")
        {
          $item->asset_approval = $request->asset_approval;
          $item->save();
        }

        return redirect()->route('asset.index');
    }

    public function disposalpending()
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }

      $user = Auth::user()->role_id;
      if($user != "ADMIN")
      {
          return view('errors.404');
      }

      $items = Item::select([
        'id', 'asset_number', 'item',
         'amount',  'current_value', 'purchase_date', 'asset_approval', 'disposal_status', 'disposal_date', 'sales_invoice',
         'agreed_price', 'further_info'
      ])->where('asset_approval', 'APPROVED')->where('disposal_status', 'PENDING')->get();

      return view('asset.disposalpending', ['items'=> $items]);
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

        $user = Auth::user()->role_id;
        $userd = Auth::user()->department;
        if($user == "BASIC" && $userd != "FINANCE")
        {
            return view('errors.404');
        }

        //$stuff = "None";
        $item = new Item;
        $item->item = $request->item;
        $item->invoice_number = $request->invoice_number;
        if(empty($request->serialno))
        {
            $item->serialno = "N/A";
        }
        else
        {
            $item->serialno = $request->serialno;
        }
        $item->location = $request->location;
        $item->classification = $request->classification;
        $item->supplier_details = $request->supplier_details;
        $item->department = $request->department;
        $item->description = $request->description;
        $item->amount = $request->amount;
        $item->purchase_date = $request->purchase_date;
        $item->economiclife = $request->economiclife;
        $item->current_year = $request->economiclife;
        $item->isdepreciate = $request->isdepreciate;
        $item->current_value = $request->amount;
        $item->residual_value = $request->residual_value;
        $item->disposal_status = "AVAILABLE";
        $item->asset_approval = $request->asset_approval;
        $item->created_by = $request->created_by;
        if($request->isdepreciate == "No")
        {
          $item->depreciationformula= "None";
        }
        else
        {
          $item->depreciationformula = $request->depreciationformula;

          if( $request->depreciationformula == "REDUCING BALANCE METHOD")
          {
            $item->rate = $request->rate;
          }
          else
          {
            $item->rate = "0";
          }
        }
        //$item->asset_number = $stuff;

        $pers = DB::table('users')->where('role_id', 'ADMIN')->first();

        //mail function
        $this->sendEmailAdd($item->item, $pers->email, $item->location, $item->classification, $item->amount);

        $item->save();

        $item_update = Item::find($item->id);

        $classi = $request->classification;
        $depti = $item->department;
        $id = $item->id;
        $gense = $this->generateSerial($classi, $depti, $id);

        $item_update->asset_number = $gense;

        $item_update->save();


        $depreciation = new Depreciation;

        $depreciation->id = $item->id;

        $depreciation->save();

        $user = Auth::user()->role_id;
        if($user == "ADMIN")
        {
            return redirect()->route('asset.index');
        }

        $userr = Auth::user();

        $classifications = Classification::all();

        $departments = Department::all();

        //return view('items.create', ['classifications'=>$classifications, 'user' => $userr, 'departments'=>$departments]);
        return redirect()->route('items.create', ['classifications'=>$classifications, 'user' => $userr, 'departments'=>$departments, 'ret'=>'Successfully Registered Asset']);
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

      return view('items.reports', ['classifications'=>$classifications, 'departments'=>$departments]);
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

      if(!empty($request->economiclife)){
      $economiclife = $request->economiclife;
      }else { $economiclife = "";}

      if(!empty($request->residual_value_from)){
      $residualfrom = $request->residual_value_from;
      }else { $residualfrom = "";}

      if(!empty($request->residual_value_to)){
      $residualto = $request->residual_value_to;
      }else { $residualto = "";}

      if(!empty($request->department)){
      $department = $request->department;
      }else { $department = "";}

      if(!empty($request->amount_from)){
      $amountfrom = $request->amount_from;
      }else { $amountfrom = "";}

      if(!empty($request->amount_to)){
      $amountto = $request->amount_to;
      }else { $amountto = "";}

      if(!empty($request->depreciation_from)){
      $deprefrom = $request->depreciation_from;
      }else { $deprefrom = "";}

      if(!empty($request->depreciation_to)){
      $depreto = $request->depreciation_to;
      }else { $depreto = "";}

      if(!empty($request->classification) && $request->classification != "None"){
      $classification = $request->classification;
      }else{ $classification = "";}

      if(!empty($request->purchase_date_from)){
      $datefrom = $request->purchase_date_from;
      }else{ $datefrom = "";}

      if(!empty($request->purchase_date_to)){
      $dateto = $request->purchase_date_to;
      }else{ $dateto = "";}

      /*$items = Item::select([]);
      if ($economiclife !== null) {
        $items = $items->where();
      }
      $items->get()*/

      $items = Item::select([
        'id', 'asset_number', 'serialno', 'invoice_number', 'item', 'department', 'location', 'classification', 'supplier_details',
        'description', 'amount', 'economiclife', 'current_value', 'purchase_date', 'asset_approval',
        'created_by', 'created_at'
      ])->where('asset_approval', 'APPROVED')
                    ->where('disposal_status', 'AVAILABLE');
                    if(!empty($request->economiclife)){
                    $items = $items->where('economiclife', "$economiclife");
                    }
                    if(!empty($request->residual_value_from) && !empty($request->residual_value_to)){
                    $items = $items->whereBetween('residual_value', [$residualfrom, $residualto]);
                    }
                    if(!empty($request->amount_from) && !empty($request->amount_to)){
                    $items = $items->whereBetween('amount', [$amountfrom, $amountto]);
                    }
                    if(!empty($request->purchase_date_from) && !empty($request->purchase_date_to)){
                    $items = $items->whereBetween('purchase_date', [$datefrom, $dateto]);
                    }
                    if(!empty($request->depreciation_from) && !empty($request->depreciation_to)){
                    $items = $items->whereBetween('depreciation', [$deprefrom, $depreto]);
                    }
                    if(!empty($request->classification) && $request->classification != "None"){
                    $items = $items->where('economiclife', "$classification");
                    }
                    if(!empty($request->economiclife)){
                    $items = $items->where('department', "$department");
                    }
                    /*->whereBetween('amount', [$amountfrom, $amountto])
                    ->whereBetween('depreciation', [$deprefrom, $depreto])
                    ->get();*/
      $items = $items->get();

      if(empty($items[0]))
      {
        $msg = "No result for parameters set";
        return view('items.reports', ['msg' => $msg]);
      }

      $dat = date("d-m-Y");

      //$items = $request->report_details;
      //dd($items);
      $items = json_decode($items, true);
      //$items = collect($items[0]);
      //$reporttype = $request->report_type;

          Excel::create("DAMsReport_$dat", function($excel) use($items)
          {
            $excel->sheet('Sheetname', function($sheet) use($items)
            {
                $sheet->fromArray($items, null, 'A1', false, false)->prependRow([
                  'ID', 'Asset Number', 'Serial Number', 'Invoice Number', 'Item', 'Department', 'Location', 'Classification', 'Supplier Details',
                  'Description', 'Amount', 'Economic Life', 'NBV', 'Purchase Date', 'Asset Approval',
                  'Registered by', 'Registered on'
                ]);
            });

          })->export('xls');

    }

    //mail function
    public function sendEmailAdd($item, $email, $location, $classification, $amount)
    {
      /*Mail::send('emails.pending', ['name' => $name], function ($message) use ($email){
        $message->to($email, 'User')->subject('Pending Request (DO-NOT-REPLY-THIS-EMAIL)');
      });*/

        //$user = User::findOrFail($id);
        //$msg = $name;
        Mail::send('emails.addasset', ['item' => $item, 'location' => $location, 'classification' => $classification, 'amount' => $amount], function ($m) use($email, $item)
        {
            $m->to($email, $item)->subject('New Asset (DO-NOT-REPLY-THIS-EMAIL)');
        });
    }
}
