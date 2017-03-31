<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Social;
use Socialite;
use Auth;

class SocialController extends Controller
{
    public function redirectToProviderFacebook()
    {
         return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();
        //dd($user);
        
        $account = Social::where('provider_user_id', $user->id)->where('provider', 'facebook')->first();
        if($account) {
            $u = User::where('email', $user->email)->first();
            Auth::login($u);
            
            return redirect()->route('shop.index');
        } else {
            $social = new Social();
            $social->provider_user_id = $user->id;
            $social->provider = 'facebook';
            $u = User::where('email', $user->email)->first();
            if(!$u) {
                $u = User::create([
                   'name' => $user->name,
                   'email' => $user->email,
                ]);
                $social->user_id = $u->id;
                $social->save();
                Auth::login($u);
                
                return redirect()->route('shop.index');
            }
        }
    }

    public function redirectToProviderGoogle()
    {
         return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        //dd($user);
        
        $account = Social::where('provider_user_id', $user->id)->where('provider', 'google')->first();
        if($account) {
            $u = User::where('email', $user->email)->first();
            Auth::login($u);
            
            return redirect()->route('shop.index');
        } else {
            $social = new Social();
            $social->provider_user_id = $user->id;
            $social->provider = 'google';
            $u = User::where('email', $user->email)->first();
            if(!$u) {
                $u = User::create([
                   'name' => $user->name,
                   'email' => $user->email,
                ]);
                $social->user_id = $u->id;
                $social->save();
                Auth::login($u);
                
                return redirect()->route('shop.index');
            }
        }
    }

    public function redirectToProviderTwitter()
    {
         return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallbackTwitter()
    {
        $user = Socialite::driver('twitter')->user();
        //dd($user);
        
        $account = Social::where('provider_user_id', $user->id)->where('provider', 'twitter')->first();
        if($account) {
            $u = User::where('email', $user->email)->first();
            Auth::login($u);
            
            return redirect()->route('shop.index');
        } else {
            $social = new Social();
            $social->provider_user_id = $user->id;
            $social->provider = 'twitter';
            $u = User::where('email', $user->email)->first();
            if(!$u) {
                $u = User::create([
                   'name' => $user->name,
                   'email' => $user->email,
                ]);
                $social->user_id = $u->id;
                $social->save();
                Auth::login($u);
                
                return redirect()->route('shop.index');
            }
        }
    }
}
