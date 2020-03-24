<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Auth;
use Redirect;
use DB;
use Session;
use Carbon\Carbon;
use Crypt;
use PDF;
class UserController extends Controller
{
    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (Auth::user()->level == '1') {
                return Redirect::to('/');
            } else {
                return Redirect::to('/dashboard')->with(['color' => 'green', 'msg' => "Successfully Login"]);
            }
        } else {
            return Redirect::to('/login')->with(['color' => 'red', 'msg' => "Email or Password Do not Match"]);
        }
        
    }
    public function register()
    {
        $check = DB::table('users')->where('email','=',Input::get('email'))->where('fullname','=',Input::get('fullname'))->count();
        if (Input::get('password') != Input::get('cpassword')) {
            return Redirect::to('/register')->with(['color' => 'red', 'msg' => "Password and Confirm Doesn't Match"]);
        } 
        if ($check < 1){
            $token = hash('SHA256',Input::get('email').bcrypt(Input::get('password')));
            
            $dataUser = array(
                'fullname' => Input::get('fullname'),
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('password')),
                'level' => '1',
                'forgot_pass' => $token
            );
            DB::table('users')->insert($dataUser);  
            //Now Let's Insert Customer
            $userId = DB::table('users')->where('fullname','=',Input::get('fullname'))->first()->id;
            $dataCustomer = array(
                'name' => Input::get('fullname'),
                'email' => Input::get('email'),
                'address' => Input::get('address'),
                'phone' => Input::get('phone'),
                'gender' => Input::get('gender'),
                'users_id' => $userId
            );
            DB::table('customer')->insert($dataCustomer);  
            return Redirect::to('/register')->with(['color' => 'green', 'msg' => 'User has been registered']);
        }else{
            return Redirect::to('/register')->with(['color' => 'red', 'msg' => "User already exist"]);
        }
    }       
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function insertUser()
    {
        if (Input::get('password') != Input::get('cpassword')) {
            return Redirect::to('/register')->with(['color' => 'red', 'msg' => "Password and Confirm Doesn't Match"]);
        } 
        $data = array(
            'fullname' => Input::get('fullname'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password')),
            'level' => '3'
          );
          DB::table('users')->insert($data);  
          return Redirect::to('dashboard/viewUsers')->with(['color' => 'green', 'msg' => 'An Administrator has been Added']);
    }
    public function updateUser()
    {
         $id = Input::get('id');
         $data = array(
            'fullname' => Input::get('fullname'),
            'email' => Input::get('email'),
            'level' => Input::get('level'),
            'updated_at' => Carbon::now(8)
          );
          DB::table('users')->where('id','=',$id)->update($data);  
          return Redirect::to('dashboard/viewUsers')->with(['color' => 'green', 'msg' => 'A User has been updated']);
    }
    public function deleteUser()
    {
        $id = Input::get('id');
        DB::table('users')->where('id','=',$id)->delete();  
        return Redirect::to('dashboard/viewUsers')->with(['color' => 'green', 'msg' => 'Sucessfully Deleted A User']);
    }
    public function insertCustomer()
    {
        $id = Auth::user()->id;
        $data = array(
            'name' => Input::get('fullname'),
            'email' => Input::get('email'),
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
            'gender' => Input::get('gender'),
            'users_id' => $id
          );
          DB::table('customer')->insert($data);  
          return Redirect::to('dashboard/viewCustomers')->with(['color' => 'green', 'msg' => 'A Passenger has been Added']);
    }
    public function updateCustomer($id)
    {
         $data = array(
            'name' => Input::get('fullname'),
            'email' => Input::get('email'),
            'address' => Input::get('address'),
            'phone' => Input::get('phone'),
            'gender' => Input::get('gender'),
          );
          DB::table('customer')->where('id','=',$id)->update($data);  
          return Redirect::to('dashboard/viewCustomers')->with(['color' => 'green', 'msg' => 'A Passenger has been updated']);
    }
    public function deleteCustomer($id)
    {
        DB::table('customer')->where('id','=',$id)->delete();  
        return Redirect::to('dashboard/viewCustomers')->with(['color' => 'green', 'msg' => 'Sucessfully Deleted A Passenger']);
    }

    public function forgotPass()
    {
        $email = Input::get('email');
        $pass = DB::table('users')->where('email','=',$email)->first()->password;

     
        $user = DB::table('users')->where('email','=',$email);
        if ($user->count() < 1) {
            return Redirect::to('/forgotPass')->with(['color' => 'red', 'msg' => 'Email Invalid']);
        } else {
            $token = $user->first()->forgot_pass;
            $url = url('/changePassword/'.$token);
            $pdf = PDF::loadHTML('<h1><a href="'.$url.'">CLICK HERE TO CHANGE YOUR PASSWORD</a></h1>');
            // $pdf->set_base_path();
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download("Reiseziel Forgot Password.pdf");
            // return view('admin.reservations.data-reservations');
        }
        
    }
    public function changePassword($token)
    {
      $dbtoken = Db::table('users')->where('forgot_pass','=',$token)->count();
      if ($dbtoken < 1) {
        return Redirect::to('changePassword/'.$token)->with(['color' => 'red', 'msg' => 'Token Invalid']);
      } else {
        $password =  Input::get('password');
        $cpassword =  Input::get('cpassword');
        DB::table('users')->where('forgot_pass','=',$token)->update(['password' => bcrypt($password) ]);
        return Redirect::to('login')->with(['color' => 'green', 'msg' => 'Password Has Been Changed']);
      }
      

    }
}