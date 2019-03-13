<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\UserPurpose;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'type' => 'required|in:'.implode(array_keys(User::TYPES), ','),
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'acceptance' => 'required|accepted',
            'purposes' => 'required|array|max:3',
            'purposes.*' => 'numeric|in:'.implode(array_keys(User::PURPOSES), ','),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => uniqid(mt_rand(100, 999)),
            'type' => $data['type'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        UserPurpose::where('user_id', $user->id)->delete();// Unexpected so need to be deleted
        if (isset($data['purposes']) && is_array($data['purposes']) && count($data['purposes']) > 0) {
            foreach ($data['purposes'] as $purposes_id) {
                $purpose = new UserPurpose;
                $purpose->user_id = $user->id;
                $purpose->purpose_id = $purposes_id;
                $purpose->save();
            }
        }
        return $user;
    }
}
