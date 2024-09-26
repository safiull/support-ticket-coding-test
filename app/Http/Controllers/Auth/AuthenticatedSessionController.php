<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->json([
            'message' => __('Logged In Successfully'),
            'redirect' => $this->redirectTo(),
        ]);
    }

    public function redirectTo()
    {
        $auth = Auth::user();

        if ($auth->role == 'admin') {
            return $this->redirectTo = route('admin.supports.index');
        } elseif ($auth->role == 'customer') {
            return $this->redirectTo = route('customer.supports.index');
        }

        $this->middleware('guest')->except('logout');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
