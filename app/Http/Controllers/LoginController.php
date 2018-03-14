<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
class LoginController extends Controller
{
    //
    public function index(){
      if(session('logged_in')==TRUE){
        return redirect('dashboard');
      }else{
        return view('index');
      }
    }

    public function proses_login(Request $request){
      $this->validate($request,[
        'username'=>'required',
        'password'=>'required'
      ]);

      $username = $request->username;
      $password = md5($request->password);

      if(Login::where('username',$username)->where('password',$password)->first()){
        session(['logged_in'=>TRUE,'username'=>$username]);
        return redirect('dashboard');
      }else{
        return redirect('/')->with('message','Username or Password was incorrect');
      }

    }

    public function proses_logout(){
      session()->flush();
      return redirect('/');
    }
}
