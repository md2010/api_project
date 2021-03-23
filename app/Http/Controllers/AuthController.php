<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Events\RegistrationProccesed;
use Event;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return response()->format('Invalid Credentials', null, null);
        }

        return response()->format('Authorization successfull!', 'access token', $this->user());
    }

    public function user()
    {
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return $accessToken;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();     
        $user = $this->store($data);

        Event::dispatch(new RegistrationProccesed($user));
        return response()->format('You are registred! Please confirm on your mail.', null, null);
    }

    public function store(array $data)
    {  
        $user = new User();
        foreach($data as $key => $value) {
            if($key == 'password') {
                $user->$key = Hash::make($data['password']);
            }
            $user->$key = $value;
        }           
        $user->contract_start_date = now();
        $user->contract_end_date = now()->addYear(); 
        $user->remember_token = Str::random(10);
        $user->save();

        return $user;
    }

    public function emailVerification($id)
    {
        $user = User::findOrFail($id);
        $user->verified = true;
        $user->email_verified_at = now();
        $user->save();

        Redirect::route('login');
        return response()->format('Email verified!', null, null);
    }
    
}
