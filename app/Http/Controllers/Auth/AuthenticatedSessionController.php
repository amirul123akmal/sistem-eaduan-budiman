<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        /** @var User|null $user */
        $user = Auth::user();
        $redirectRoute = route('dashboard', absolute: false);
        
        if ($user && method_exists($user, 'hasRole')) {
            if ($user->hasRole('Super Admin')) {
                $redirectRoute = route('admin.dashboard', absolute: false);
            } elseif ($user->hasRole('Admin')) {
                $redirectRoute = route('admin.panel.dashboard', absolute: false);
            }
        }

        return redirect()->intended($redirectRoute)->with('success', 'Log masuk berjaya! Selamat datang kembali.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda telah log keluar dengan jayanya.');
    }
}
