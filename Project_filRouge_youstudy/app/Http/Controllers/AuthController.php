<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailVerificationCodeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user', 
            'password' => Hash::make(Str::random(12)),
            'img_url' => 'default.jpg', // Image par défaut
            'email_verification_code' => sprintf("%06d", mt_rand(100000, 999999)),
        ]);

        $user->notify(new EmailVerificationCodeNotification());

        return redirect()->route('verification.notice', ['email' => $user->email]);
    }

    public function showVerification(Request $request)
    {
        $email = $request->email;
        return view('verification', compact('email'));
    }

    public function verify(Request $request)
    {
        $code = '';
        for ($i = 1; $i <= 6; $i++) {
            $code .= $request->input('code_' . $i);
        }

        $request->merge(['verification_code' => $code]);

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)
                    ->where('email_verification_code', $request->verification_code)
                    ->first();

        if (!$user) {
            return back()->withErrors(['verification_code' => 'Le code de vérification est incorrect']);
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('complete.registration', ['email' => $user->email]);
    }

    public function showCompleteRegistration(Request $request)
    {
        $email = $request->email;
        return view('complete_registration', compact('email'));
    }

    public function completeRegistration(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->whereNotNull('email_verified_at')
                    ->first();

        if (!$user) {
            return redirect()->route('register');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboardUser');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Vérification du rôle de l'utilisateur
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboardAdmin');
            } elseif (Auth::user()->role === 'user') {
                return redirect()->route('dashboardUser');
            }
        }
        // Si l'authentification échoue, on vérifie si l'utilisateur a vérifié son email
        $user = User::where('email', $request->email)->first(); 
        if ($user && !$user->email_verified_at) {
            return back()->withErrors([
                'email' => 'Votre adresse e-mail n\'a pas été vérifiée. Veuillez vérifier votre e-mail.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
