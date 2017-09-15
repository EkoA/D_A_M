<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use App\User;
use App\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //method to list of all vendors
      if (Auth::guest())
      {
         return view('auth.login');
      }
      $user = Auth::user()->department;
      if($user != "FINANCE")
      {
          return view('errors.404');
      }

      $vendors = Vendor::all();
      return view('vendors.index', ['vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //method to display create view
      if (Auth::guest())
      {
         return view('auth.login');
      }

      $user = Auth::user()->department;
      if($user != "FINANCE")
      {
          return view('errors.404');
      }

      return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //method to store new vendor
      if (Auth::guest())
      {
         return view('auth.login');
      }
      $user = Auth::user()->department;
      if($user != "FINANCE")
      {
          return view('errors.404');
      }

      $this->validate($request, [
        'vendor_name' => 'required|unique:vendors',
        'email' => 'required|unique:vendors',
        'product_service' => 'required|unique:vendors',
      ]);

      $vendor = new Vendor;
      $vendor->vendor_name = $request->vendor_name;
      $vendor->address = $request->address;
      $vendor->phone = $request->phone;
      $vendor->email = $request->email;
      $vendor->product_service = $request->product_service;
      if(!empty($request->vat_num))
      {
      $vendor->vat_num = "N/A";
      }
      $vendor->comments = $request->comments;
      $vendor->save();

      $name = $request->vendor_name;

      $ret = "Successfully added $name to Vendor list";

      return view('vendors.create', ['ret'=>$ret]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //method to display details of a vendor
        if (Auth::guest())
        {
           return view('auth.login');
        }
        $user = Auth::user()->department;
        if($user != "FINANCE")
        {
            return view('errors.404');
        }

        $vendor = Vendor::find($id);
        return view('vendors.show', ['vendor'=>$vendor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //method to display edit view
        $vendor = Vendor::find($id);
        return view('vendors.edit', ['vendor'=>$vendor]);
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
      $this->validate($request, [
      'product_service' => 'required|unique:vendors',
      'vendor_name' => 'required|unique:vendors',
      'email' => 'required|unique:vendors',
      ]);

        //method to update vendor records
        $vendor = Vendor::find($id);
        $vendor->vendor_name = $request->vendor_name;
        $vendor->address = $request->address;
        $vendor->product_service = $request->product_service;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        if(!empty($request->vat_num))
        {
        $vendor->vat_num = "N/A";
        }
        $vendor->comments = $request->comments;
        $vendor->save();

        $name = $request->vendor_name;

        $ret = "Successfully edited $name ";

        return view('vendors.show', ['vendor'=>$vendor]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //method to delete a vendor
        Vendor::destroy($id);
        $vendors = Vendor::all();
        return view('vendors.index', ['vendors'=>$vendors]);
    }
}
