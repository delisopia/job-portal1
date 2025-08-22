<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        $user = Auth::user();

        if ($user->role === 'perusahaan') {
            session()->forget('url.intended'); 
            return redirect()->route('perusahaan.dashboard');
        }
        
        if ($user->role === 'admin') {
            session()->forget('url.intended'); 
            return redirect()->route('admin.dashboard');
        }
        


        // ✅ Redirect custom
        if ($request->has('redirect')) {
            return redirect($request->redirect);
        }

        // ✅ Default redirect (pencari kerja)
        return redirect()->intended(route('jobs.index'));
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'cv_path' => $cvPath,
            'role' => 'job_seeker'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}