<?php
namespace Haunt\Http\Controllers\Admin;

use Haunt\Extend\Controller;
use Haunt\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
	/**
	 * Show the edit view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function edit(): \Illuminate\View\View
	{
		return view('haunt::auth.login');
	}

	/**
	 * Handle editing a resource.
	 *
	 * @param \Haunt\Http\Requests\Auth\LoginRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(LoginRequest $request): \Illuminate\Http\RedirectResponse
	{
        if(auth()->guard('haunt')->attempt(['email_address' => $request->input('email_address'), 'password' => $request->input('password')])) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
	}
}
