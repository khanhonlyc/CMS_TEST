<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = RouteServiceProvider::HOME;
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
            'sort_no' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'user_name' =>  ['required', 'max:255'],
            'permission' =>  ['required', 'max:255'],
            'created_at' =>  ['required', 'max:255'],
            'create_user' =>  ['required', 'max:255'],
            'updated_at' =>  ['required', 'max:255'],
            'update_user' =>  ['required', 'max:255'],
            'deleted_at' =>  ['required', 'max:255'],
            'delete_user' =>  ['required', 'max:255']
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'sort_no' => $data['sort_no'],
            'user_id' => $data['user_id'],
            'password' => Hash::make($data['password']),
            'user_name' => $data['user_name'],
            'permission' => $data['permission'],
            'created_at' => $data['created_at'],
            'create_user' => $data['create_user'],
            'updated_at' => $data['updated_at'],
            'update_user' => $data['update_user'],
            'deleted_at' => $data['deleted_at'],
            'delete_user' => $data['delete_user'],
        ]);
    }
}
