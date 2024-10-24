<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Article;
use App\Models\Bidding;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create($validatedData);
        Auth::login($user);
        //dd($validatedData);
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('User.login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request) //This is actually a login function
    {
        $validatedData = $request->validated();
        // TODO: liever op basis van emailadres opvragen
        $user = User::where('name', $request->name)->first();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The provided password is incorrect.']);
        }
        // dd($validatedData);
        if(Auth::attempt($validatedData)) {
            return redirect()->route('articles.index');
        }
        //dd('niet ingelogd');
        
        //return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        Auth::logout($user);
        return redirect()->route('articles.index');
    }

    public function password(Request $request) {
        

        RateLimiter::clear($request->input('email'));
        // Mail::raw('This is a test email. \n localhost:8000/new-password', function ($message) {
        //     $message->to('your_test_email@example.com')
        //             ->subject('Test Email');
        // });
        $status = Password::sendResetLink($request->only('email'));
        //dd('mail sent(?)...');

        if(true) {
            $message = 'Password reset mail has been sent. Check your mailbox.';
        } else {
            $message = 'Failed to send password reset mail. Enter new mailadress.';
        }

        return view('user.login')->withMessage($message);
    }

    public function newpassword(Request $request) {
        return view('user.passwordreset', ["email" => $request->get("email"), "token" => $request->get("token")]);
    }

    public function changepassword(StorePasswordRequest $request) {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('users.show')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }
}
