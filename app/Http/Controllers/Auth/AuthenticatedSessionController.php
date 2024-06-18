<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
        try {
            $request->authenticate();
            $request->session()->regenerate();

            // Set success message
            session()->flash('success', 'Login berhasil!');

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (ValidationException $e) {
            // Set validation error message
            session()->flash('error', 'Validasi gagal: ' . $e->getMessage());

            return redirect()->route('login')->withErrors($e->errors());
        } catch (AuthenticationException $e) {
            // Set authentication error message
            session()->flash('error', 'Autentikasi gagal: ' . $e->getMessage());

            return redirect()->route('login');
        } catch (\Exception $e) {
            // Set general error message
            session()->flash('error', 'Login gagal: ' . $e->getMessage());

            return redirect()->route('login');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Set logout message
        session()->flash('success', 'Logout berhasil!');

        return redirect('/');
    }
}

