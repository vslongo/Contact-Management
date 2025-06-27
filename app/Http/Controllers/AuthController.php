<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return $this->renderHtml('auth/login.html');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('contacts.index'));
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    protected function renderHtml($viewPath, $data = [])
    {
        extract($data);
        ob_start();
        require resource_path('views/' . $viewPath);
        $content = ob_get_clean();
        return response()->file(resource_path('views/layouts/app.html'), ['content' => $content]);
    }
}
