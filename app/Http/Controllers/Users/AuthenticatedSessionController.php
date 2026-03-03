<?php

namespace App\Http\Controllers\Users;

use App\Action\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(
        LoginAction $Action,
        LoginRequest $request
    ): RedirectResponse {

        $validated = $request->validated();
        if($Action->execute($validated)) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'username' => 'invalid credentials.',
            'password' => 'incorrect password.'
        ]);
    }
}
