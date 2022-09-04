<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class fontController extends Controller
{
    public function index(){
        return view('index');
    }
    public function login(){
        return view('login');
    }
    public function login_store(Request $request){
        if (Auth::guard('Patient')->attempt(['email' => $request -> email,'password' => $request -> password]) ) {
            if (Auth::guard('Patient')->user()-> token == null && Auth::guard('Doctor')->user()-> status == true) {
                return redirect() -> route('p.dashboard');
            }else{
                Auth::guard('Patient') -> logout();
                return redirect() -> route('login.page') -> with('danger','Token didnt activated');
            }
        }elseif(Auth::guard('Doctor')->attempt(['email' => $request -> email,'password' => $request -> password])){
            if (Auth::guard('Doctor')-> user() -> token == null && Auth::guard('Doctor')->user()-> status == true) {
                return redirect() -> route('d.dashboard');
            }else{
                Auth::guard('Doctor') -> logout();
                return redirect() -> route('login.page') -> with('danger','Token didnt activated');
            }
        }else{

            return redirect() -> route('login.page') -> with('danger','Password or email didnt match');
        }
    }
}
