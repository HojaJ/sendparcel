<?php

namespace App\Http\Controllers\Auth;

use App\Events\Frontend\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        if($request->type === 'client' || $request->type === 'deliveryman'){
            $type = $request->type;
            return view('auth.register', compact('type'));
        }else{
            return redirect()->route('frontend.index');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->type);

        Auth::login($user);
        \Artisan::call('optimize:clear');
        return redirect(RouteServiceProvider::HOME);
    }
}
