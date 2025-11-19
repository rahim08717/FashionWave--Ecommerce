<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\GoogleProvider $googleProvider */
            $googleProvider = Socialite::driver('google');

            $googleUser = $googleProvider->stateless()->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('123456dummy'), // <-- password দিতে হবে
                    'image' => $googleUser->getAvatar() ?? 'default.png'
                ]);
            }

            Auth::login($user);

            return redirect(url('/'));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
