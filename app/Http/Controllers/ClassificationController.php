<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use App\User;
use App\Classification;
use Mail;
use App\Item;
use Dompdf\Dompdf;
use PDF;
use App;
use Excel;

class ClassificationController extends Controller
{
    //
    public function index()
    {
    	if (Auth::guest())
        {
           return view('auth.login');
        }

        $classifications = Classification::all();

        return view('classifications.index')->with('classifications', $classifications);
    }

    public function create()
    {
    	if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user != "HOF")
        {
           return view('errors.404');
        }

        return view('classifications.create');
    }

    public function show($id)
    {
        $classification = Classification::find($id);
        //dd($classification);
        //return $classification->class_name;
        $classmembers = Item::select([
          'id', 'asset_number', 'serialno', 'invoice_number', 'item', 'department', 'location', 'classification', 'supplier_details',
          'description', 'amount', 'economiclife', 'isdepreciate', 'depreciationformula', 'current_value', 'purchase_date', 'asset_approval',
          'created_by', 'created_at'
        ])->where('classification', $classification->class_name)
        ->where('asset_approval', 'APPROVED')
        ->where('disposal_status', 'AVAILABLE')->get();

      /*  $classmembers = Item::select([
          'id', 'asset_number',  'item', 'amount',
        ])->where('classification', $classification->class_name)->where('asset_approval', 'APPROVED')->where('disposal_status', 'AVAILABLE')->get();*/

        //dd($classmembers);

        return view('classifications.show', ['classmembers' => $classmembers, 'classification' => $classification]);
    }

    protected function generateReport(Request $request)
    {
      //return "Hello";
      $dat = date("d-m-Y");

      $items = $request->report_details;

      $items = json_decode($items, true);

      //$items = collect($items[0]);
      //dd($items);
      //$reporttype = $request->report_type;
          Excel::create("DAMsReport_$dat", function($excel) use($items)
          {
            $excel->sheet('Sheetname', function($sheet) use($items)
            {
                $sheet->fromArray($items, null, 'A1', false, false)->prependRow([
                  'ID', 'Asset Number', 'Serial Number', 'Invoice Number', 'Item', 'Department', 'Location', 'Classification', 'Supplier Details',
                  'Description', 'Amount', 'Economic Life', 'Depreciable', 'Depreciation Formula', 'Current Value', 'Purchase Date', 'Asset Approval',
                  'Registered by', 'Registered on'
                ]);
            });
          })->export('xls');
    }

    public function store(Request $request)
    {
    	if (Auth::guest())
        {
           return view('auth.login');
        }

        $user = Auth::user()->role_id;
        if($user != "HOF")
        {
            return view('errors.404');
        }

        $classification = new Classification;
        $classification->class_name = $request->class_name;
        $classification->short_code = $request->short_code;
        $classification->description = $request->description;

        $classification->save();

        ///$ret = "Success!";
        return view('classifications.create',  ['ret' => 1]);
    }

    public function destroy($id)
    {
        echo $id;
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
        //dd($id);

        Classification::destroy($id);

        return redirect()->route('classifications.index');
    }

}
