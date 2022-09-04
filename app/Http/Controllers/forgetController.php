<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\password_reset;
use App\Models\Patient;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class forgetController extends Controller
{
    public function f_password_page(){
        return view('forget-password.forget-password');
    }
    public function f_password_check(Request $request){
        if (Doctor::where('email',$request -> email) -> first()) {
            //token create
        $token = md5(time().rand());
        $noti = password_reset::create([
            'token' => $token,
            'email' => $request -> email
        ]);
        $noti -> notify(new ForgetPasswordNotification($noti));
        if ($noti) {
            return back() -> with('success','Notification Send');
        }else{
            return back() -> with('danger','Notification cant Send');
        }
        }elseif(Patient::where('email',$request -> email) -> first()){
        //token create
        $token = md5(time().rand());
        $noti = password_reset::create([
            'token' => $token,
            'email' => $request -> email
        ]);
        $noti -> notify(new ForgetPasswordNotification($noti));
        if ($noti) {
            return back() -> with('success','Notification Send');
        }else{
            return back() -> with('danger','Notification cant Send');
        }
        }
        
    }
    public function f_password_reset(Request $request, $token = null, $email){
        return view('forget-password.forget-reset')->with(['token' => $token,'email' => $request -> email]);
    }
    public function f_password_reset_store(Request $request){
        $this -> validate($request,[
            'password' => 'required|confirmed',
        ]);
        //token and email check
        $check = password_reset::where([
         'email' => $request -> email,
         'token' => $request -> token,
        ])->first();
        if (!$check) {
            return back() -> with('danger','Token Didnt match');
        }else{
            Patient::where('email', $request -> email)->update([
                'password' => Hash::make($request -> password),
            ]);
            password_reset::where([
                'email' => $request -> email,
            ])-> delete();
            
            Doctor::where('email', $request -> email)->update([
                'password' => Hash::make($request -> password),
            ]);
            password_reset::where([
                'email' => $request -> email,
            ])-> delete();
            return redirect() -> route('login.page') -> with('success','Password Changed');
        }
    }
}
