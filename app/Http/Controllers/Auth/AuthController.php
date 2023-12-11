<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function index()
    {
        return Inertia::render('auth/login', [
            'title' => 'Iniciar sesión',
        ]);
    }

    public function signIn(SignInRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/a');
        }
        return back()->withErrors([
            "error" => "Las credenciales no coinciden con nuestros registros."
        ]);
    }

    public function signOut()
    {
        Auth::logout();

        return redirect('/');
    }

    public function forgotPassword()
    {
        return Inertia::render('auth/forgot-password');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(
            [
                "email" => ["required", "email", "exists:users,email"]
            ],
            [
                "email.required" => "El email es requerido.",
                "email.email" => "El email debe ser válido.",
                "email.exists" => "No se ha encontrado un usuario con ese correo electrónico."
            ]
        );

        $user = User::where("email", $request->email)->first();

        if ($user) {
            $token = Crypt::encryptString($request->email);
            Mail::to($user->email)->send(new ResetPasswordEmail($user, $token));
            return back()->with("success", "Se ha enviado un correo electrónico con un enlace para restablecer la contraseña.");
        }

        return back()->withErrors("error", "No se ha encontrado un usuario con ese correo electrónico.");


    }

    public function resetPassword(Request $request)
    {
        $token = $request->token;
        $email = Crypt::decryptString($token);
        $user = User::where("email", $email)->first();

        if ($user) {
            return Inertia::render('auth/reset-password', [
                "token" => $token,
                "email" => $email
            ]);
        }

        return Inertia::render('auth/login')->with("error", "Invalid password reset link!");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "password" => ["required"],
            "token" => ["required"],
        ]);

        $email = Crypt::decryptString($request->token);

        $user = User::where("email", $email)->first();

        if ($user) {
            $user->password = $request->password;
            $user->save();

            return redirect('/auth/login');
        }

        return back()->with("error", "Invalid password reset link!");
    }
}
