<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        return view('form.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        // Check the authenticated user's role and redirect accordingly
        if (auth()->user()->role === 'Admin') {
            return redirect()->intended(route('admin.any', ['any' => 'dashboard'], false));
        } elseif (auth()->user()->role === 'User') {
            return redirect()->intended(route('home', absolute: false));
        }
    
        // Default fallback redirection (optional, for safety)
        return redirect()->intended(route('home', absolute: false));
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user->is_online = 0; // Mark the user offline
        $user->save();
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
