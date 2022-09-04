<?php

namespace App\Http\Controllers;

use Str;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\password_reset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\patientaccount;
use App\Notifications\ForgetPasswordNotification;
use PDO;

class patientController extends Controller
{
    public function p_register(){
        return view('patient.patientRegister');
    }
    public function p_dashboard(){
        return view('patient.patientdashboard');
    }
    public function p_register_create(Request $request){
    $this -> validate($request,[
        'email' => 'required',
        'password' => 'required|confirmed'
    ]);
    $token = md5(time().rand());
    //data store
    $patient = Patient::create([
        'email' => $request -> email,
        'password' => Hash::make($request -> password),
        'token' => $token,
    ]);
    $patient -> notify(new patientaccount($patient));

    return back() -> with('success','Register Done');
   }
   public function p_activation($token = null){
   if (!$token) {
    return redirect() -> route('login.page') -> with('danger','Token Not Found');
   }
   //token check
   if ($token) {
    $data = Patient::where('token',$token) -> first();
    $data -> update([
        'token' => null,
        'status' => true,
    ]);
    return redirect() -> route('login.page') -> with('success','Your account is activated now Log in');
   }else{
    return redirect() -> route('login.page') -> with('success','Your account is not activated');
   }
   
   
   }
  

    public function p_login(Request $request){
        if (Auth::guard('Patient')->attempt(['email' => $request -> email,'password' => $request -> password])) {
            if (Auth::guard('Patient') -> user() -> token == null && Auth::guard('Patient') -> user() -> status == true) {
                return redirect() -> route('p.dashboard');
            }else{

                Auth::guard('Patient') -> logout();
                return redirect() -> route('login.page') -> with('danger','Please Activate the Token and then login');
            }
        }else{
            return redirect() -> route('login.page') -> with('success','not match');
        }
    }
    public function p_logout(){
        Auth::guard('Patient') -> logout();
        return redirect() -> route('login.page')->with('success','You are Log out');
    }
    public function p_password(){
        return view('patient.patient-change-password');
    }
    public function p_password_change(Request $request){
        if (!password_verify($request -> old_password,Auth::guard('Patient')->user()-> password)) {
            return back() -> with('danger','Old Password didnt match');
        }
        //password confirmation
        if ($request -> password != $request -> password_confirmation ) {
            return back() -> with('danger','New password didnt match');
        }
        $pass = Patient::find(Auth::guard('Patient') -> user() -> id);
        $pass -> update([
            'password' => Hash::make($request -> password)
        ]);
        Auth::guard('Patient')-> logout();
        return redirect() -> route('login.page')-> with('success','Password Changed');
    }
    public function p_setting(){
        $data = Patient::find(Auth::guard('Patient') -> user() -> id);
        return view('patient.patientsetting',compact('data'));
    }
    public function p_setting_store(Request $request){
        $this -> validate($request,[
            'f_name' => 'required'
        ]);
        if ($request -> hasFile('new_photo')) {
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'. $img -> clientExtension();
            $img -> move(storage_path('app/public/photos'),$file_name);
        }else{
            $file_name = $request -> old_photo;
        }
        $data = Patient::find(Auth::guard('Patient') -> user() -> id);
        $data -> update([
            'photo' => $file_name,
            'f_name' => $request -> f_name,
            'l_name' => $request -> l_name,
            'date_of_birth' => $request -> date_of_birth,
            'blood' => $request -> blood,
            'email' => $request -> email,
            'cell' => $request -> cell,
            'address' => $request -> address,
            'city' => $request -> city,
            'state' => $request -> state,
            'zip' => $request -> zip,
            'country' => $request -> country
        ]);
        return back();
    }

  public function p_forget_page(){
    return view('patient.patient-forget');
  }
  
  
   

}
