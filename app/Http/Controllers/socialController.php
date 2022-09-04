<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class socialController extends Controller
{
    public function facebook_login_req(){
        return Socialite::driver('facebook') -> redirect();
    }
    //facebook login info
    public function facebook_login_system(){
        $user = Socialite::driver('facebook')->user();
        $login = Patient::where('facebook_id',$user -> id) -> first();
       if ($login) {
        Auth::guard('Patient')->login($login);
        return redirect('/patient-dashboard ');
       }else{
        $patient = Patient::create([
            'f_name' => $user -> name,
            'status' => true,
            'facebook_id' => $user -> id,
        ]);
       }
       Auth::guard('Patient')->login($patient);
       return redirect('/patient-dashboard');
    }
    //github
    public function github_login_req(){
        return Socialite::driver('github')-> redirect();
    }
    public function github_login_system(){
        $user = Socialite::driver('github')->user();
        $login = Patient::where('github_id',$user -> id) -> first();
        if ($login) {
            Auth::guard('Patient')->login($login);
            return redirect('/patient-dashboard');
        }else{
            $patient_git= Patient::create([
                'f_name' => $user -> name,
                'status' => true,
                'github_id' => $user -> id,
            ]);
        }
        Auth::guard('Patient')->login($patient_git);
        return redirect('/patient-dashboard');
    }

    }

