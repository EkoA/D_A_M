<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;
use App\User;
use DB;
use Auth;
use Session;
use App\Department;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class UserController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
          $dept =  Auth::user()->department;
          if($check!="HOD" && $dept!="HUMAN CAPITAL")
          {
            return view('errors.404');
          }
        }

        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index')->with('users', $users);
    }

    public function checker()
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
            if($checkpass!="YES")
            {
                $user = Auth::user()->id;
                //return $user;
                return view('users.changepassword')->with('user', $user);
            }

            return view('orders.create')->with('user', $user);;
        }


        if($role == "HOF")
        {

            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass!="YES")
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
                     ->get();

            return view('finances.index', ['orders' => $corders, 'items' => $citems]);
        }


        if($role == "HOD")
        {

            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass!="YES")
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
            $checkpass = Auth::user()->account_activated;
            //return $checkpass;
            if($checkpass!="YES")
            {
                $user = Auth::user()->id;
                //return $user;
                return view('users.changepassword')->with('user', $user);
            }

            $users = User::all();

            $corders = DB::table('orders')
                     ->select(DB::raw('count(*) as order_count'))
                     ->where('admin_approval', 'PENDING')
                     ->get();

            $citems = DB::table('items')
                     ->select(DB::raw('count(*) as item_count'))
                     ->get();

            $cuser = DB::table('users')
                     ->select(DB::raw('count(*) as user_count'))
                     ->get();

            return view('home', ['users' => $users, 'orders' => $corders, 'items' => $citems, 'uzer' => $cuser]);
        }
    }

    public function activatemail($id)
    {
      $user = User::find($id);
      $email = $user->email;
      $genpa = $this->generatePassword($email);
      $this->sendEmailReminder($user->email, $user->name, $genpa);
      $msg = "Successfully Resent activation mail";
      return view("users.show", ['msg'=>$msg, 'user'=>$user]);
    }

    public function resetpassword($id)
    {
      //
      $user = User::find($id);
      $user->account_activated = "NO";
      $user->password = bcrypt("password");
      $user->save();

      $name = $user->name;
      $email = $user->email;

      //return "Hello";
      /*Mail::queue('emails.resetpassword', ['name' => $name], function ($m) use($email, $name){
          $m->to($email, $name)->subject('DAMS Account (DO-NOT-REPLY-THIS-EMAIL)');
      });*/

      /*if(Mail::failures())
      {
        $msg = 'Failed to send password reset email, please try again.';
      }*/

      /*if(count(Mail::failures()) > 0)
      {
         foreach(Mail::failures as $email_address) {
             echo "$email_address <br />";
          }
      } else {
          echo "Mail sent successfully!";
      }*/

      /* if(count(Mail::failures()) > 0){
          $msg = 'Failed to send password reset email, please try again.';
      }*/

      $msg = "Successfully Reset password";
      return view("users.show", ['msg'=>$msg, 'user'=>$user]);
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
        if($check=="BASIC" || $check=="HOF")
        {
            return view('errors.404');
        }

        $user = User::find($id);
        return view('users.show')->with('user', $user);
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
        if($check!="ADMIN")
        {
          $dept =  Auth::user()->department;

          if($check!="HOD" && $dept!="HUMAN CAPITAL")
          {
            return view('errors.404');
          }
        }

        $user = User::find($id);
        $departments = Department::all();

        return view('users.edit', ['departments'=>$departments, 'user' => $user]);
    }

    public function getLogout()
    {
        auth()->logout();

        return redirect()->route('auth.login');
    }

    public function changepassword(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //dd("Eko");
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user ->account_activated = $request->account_activated;
        $user->save();

        Auth::logout();
		//Session::flush();
		return redirect('/logout');

		return view('auth.logout');
        //return view('/');
        //return redirect()->route('/');
        //getLogout();
    }

    public function update(Request $request, $id)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }
        //checking user role
        /*$check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
            return view('auth.login');
        }*/

        //$user = new User;

        $user = User::find($id);
        //dd($user);

        $user->name=$request->name;
        $user->email=$request->email;
        $user->role_id=$request->role_id;
        $user->department=$request->department;

        $user->save();

        $check = Auth::user()->role_id;
        $dept =  Auth::user()->department;

          if($check!="HOD" && $dept!="HUMAN CAPITAL")
          {
            return view('users.show')->with('user', $user);
          }
          else
          {
            return view('users.show')->with('user', $user);
          }
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
        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
            return view('errors.404');
        }

        User::destroy($id);
        return redirect()->route('users.index');
    }

    protected function generatePassword($email)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //function to generate password from user email, year and @ sign

        $ema = substr($email, 0,4);
        $dat = date("Y");

        $genpass = $ema ."@". $dat;

        return $genpass;
    }

    public function addstaff()
    {
      if (Auth::guest())
      {
         return view('auth.login');
      }
      //return "Hello";
      //checking user role
      $check = Auth::user()->role_id;
      if($check!="ADMIN")
      {
        $dept =  Auth::user()->department;

        if($check!="HOD" && $dept!="HUMAN CAPITAL")
        {
          return view('errors.404');
        }
      }

      $user = Auth::user();
      $departments = Department::all();
      return view('users.addstaff', ['departments'=>$departments, 'user' => $user]);
    }

    public function viewstaff()
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        //checking user role
        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
          $dept =  Auth::user()->department;
          if($check!="HOD" && $dept!="HUMAN CAPITAL")
          {
            return view('errors.404');
          }
        }

        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('users.viewstaff', ['users' => $users]);
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
        $check = Auth::user()->role_id;
        if($check!="ADMIN")
        {
          $dept =  Auth::user()->department;
          if($check!="HOD" && $dept!="HUMAN CAPITAL")
          {
            return view('errors.404');
          }
        }

        $this->validate($request, [
            //'name' => 'required|max:255',
            'staffid' => 'required|max:255|unique:users,staffid',
            'email' => 'required|email|max:255|unique:users,email',
            //'password' => 'required|min:6|confirmed',
        ]);

        $user = new user;

        //generating a password
        $genpa = $this->generatePassword($request->email);
        $email = $request->email;

        $user->staffid=$request->staffid;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role_id=$request->role_id;
        $user->department=$request->department;
        $user->account_activated=$request->account_activated;
        $user->password = bcrypt($genpa);
        //return $genpa;
        //return "Hello";
        //this is  to send the mail
        //$this->sendEmailReminder($user->email, $user->name, $genpa);
        $user->save();
        //$ret_val = ['email'=>$request->email, 'password'=>$genpa];

        if($check == "HOD")
        {
          return redirect()->route('users.addstaff', ['email' => $email, 'password' => $genpa,  'ret'=>1]);
        }

        return redirect()->route('users.create', ['email' => $email, 'password' => $genpa,  'ret'=>1]);

        //return view('users.create')->with('email', $email, 'password', $genpa);
    }

    public function blockuser($id)
    {
      $user = User::find($id);
      $acct = $user->account_activated;
      if($acct != "BLOCK")
      {
        $user->account_activated = "BLOCK";
        $msg = "Successfully Blocked User";
      }
      else if($acct == "BLOCK")
      {
        $user->account_activated = "YES";
        $msg = "Successfully Unblocked User";
      }
      $user->save();

      return view("users.show", ['msg'=>$msg, 'user'=>$user]);
    }

    public function create()
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

        $user = Auth::user();
        $departments = Department::all();
        //return view('items.create', ['classifications'=>$classifications, 'user' => $user]
        return view('users.create', ['departments'=>$departments, 'user' => $user]);
    }
/*
         * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (Auth::guest())
        {
           return view('auth.login');
        }

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    //function to change password
    protected function add(array $data)
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


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function search(Request $req)
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

        //dd($req->input('search'));
        $ords = null;
        if($req->has('search')&&($req->get('search')!=null))
        {
            $search = $req->get('search');
            $ords=User::where('id','like','%'.$search.'%')
                            ->orWhere('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%')
                            ->orWhere('staffid', 'like', '%'.$search.'%')
                            ->OrderBy('id')
                            ->paginate(20);
        }
        else
        {
            $ords = User::paginate(20);
        }

        return view('users.search',compact('ords', $ords));
    }

   /*{
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

        $orders = DB::table('orders')->where('admin_approval', 'APPROVED')->get();

        return view('finances.approved', ['orders' => $orders]);
    }*/

    public function sendEmailReminder($email, $name, $password)
    {
        //$user = User::findOrFail($id);
        //$msg = $name;
        Mail::queue('emails.creation', ['name' => $name, 'password' => $password ], function ($m) use($email, $name){
            $m->to($email, $name)->subject('DAMS Account (DO-NOT-REPLY-THIS-EMAIL)');
        });

        if(Mail::failures())
        {
          $msg = 'Failed to send password reset email, please try again.';
        }

    }

}
