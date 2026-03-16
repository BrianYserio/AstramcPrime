<?php

namespace App\Http\Controllers\Session;

use App\Action\Session\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SessionController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(
        LoginAction $action,
        LoginRequest $request
    ): RedirectResponse {

        $validated = $request->validated();
        if($action->execute($validated)) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy() {

    }
}
