<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AutoLoginController extends Controller
{
    public function __invoke(string $email)
    {
        $user = User::where('email', $email)->firstOrFail();
        Auth::login($user);
        return redirect()->intended('/admin');
    }
}
