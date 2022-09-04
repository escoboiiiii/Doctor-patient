<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Notifications\DoctorNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctoreController extends Controller
{
    public function doctor_register(){
        return view('doctore.doctor-register');
    }
    public function doctor_dashboard(){
        return view('doctore.doctor-dashboard');
    }
    public function doctor_register_store(Request $request){
        $this -> validate($request,[
            'email' => 'required|email|unique:patients',
            'password' => 'required|confirmed',
        ]);
        $token = md5(time().rand());
        $data = Doctor::create([
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
            'token' => $token,
        ]);
        $data -> notify(new DoctorNotification($data));
        return back() -> with('success','Activation Code send check your email');
    }
    public function doctor_account($token = null){
        if (!$token) {
            return redirect() -> route('d.register') -> with('danger','No Activation Code');
        }
        //token check
        $data = Doctor::where('token',$token) -> first();
        $data -> update([
            'token' => null,
        ]);
        if ($data) {
            return redirect() -> route('login.page') -> with('success','Your account activated Now Login');
        }else{
            return redirect() -> route('d.register') -> with('danger','No Activation Code');
        }
    }
    public function d_logout(){
        Auth::guard('Doctor')-> logout();
        return redirect() -> route('login.page')-> with('success','You are Log out');
    }
    public function d_password(){
        return view('doctore.doctor-change-password');
    }
    public function d_password_store(Request $request){
        $this -> validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        if (!password_verify($request -> old_password,Auth::guard('Doctor')-> user()->password)) {
            return back()-> with('danger','Old Password Didnt match');
        }
        if ($request -> password != $request -> password_confirmation) {
            return back()-> with('danger','New Password didnt match');
        }
        $data = Doctor::find(Auth::guard('Doctor') -> user() -> id);
        $data -> update([
            'password' => Hash::make($request -> password),
        ]);
        return redirect() -> route('login.page')-> with('success','Password changed Now log in');
    }
    
}
