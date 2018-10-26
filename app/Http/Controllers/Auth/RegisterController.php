<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
        return Validator::make(
            $data,
            [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'age' => ['required'],
            'phone' => ['required', 'string'],
                ],
            [
                'first_name.required' => 'Поле :attribute обезательно к заполнению.',
                'first_name.string' => 'Поле :attribute должно быть строковым.',
                'first_name.max:255' => 'Поле :attribute не должно превышать :max символов',
                'last_name.required' => 'Поле :attribute обезательно к заполнению.',
                'last_name.string' => 'Поле :attribute должно быть строковым.',
                'last_name.max:255' => 'Поле :attribute не должно превышать :max символов.',
                'email.required' => 'Поле :attribute обезательно к заполнению.',
                'email.string' => 'Поле :attribute должно быть строковым.',
                'email.email' => 'Поле :attribute должно быть в формате email.',
                'email.max:255' => 'Поле :attribute не должно превышать :max символов.',
                'email.unique:users' => 'Такой email уже существует в системе.',
                'password.required' => 'Поле :attribute обезательно к заполнению.',
                'password.string' => 'Поле :attribute должно быть строковым.',
                'password.min:6' => 'Поле :attribute далжно быть не менее :min символов',
                'password.confirmed' => 'Пароли должны совпадать.',
                'age.required' => 'Поле :attribute обезательно к заполнению.',
                'phone.required' =>'Поле :attribute обезательно к заполнению.',
                'phone.string' => 'Поле :attribute должно быть строковым.',
            ],
            [
                'first_name' => 'Имя',
                'last_name' => 'Фамилия',
                'email' => 'email',
                'password' => 'Пароль',
                'password_confirmation' => 'Подтверджение пароля',
                'age' => 'Возраст',
                'phone' => 'Мобильный телефон',
                'city' => 'Город',
                'about' => 'Обо мне',
                'image' => 'Изображение'
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
        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }
}
