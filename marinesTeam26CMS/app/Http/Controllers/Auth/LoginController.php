<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use Session;
class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */
  use AuthenticatesUsers;
  /**
   * Where to redirect users after login.
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
    $this->middleware('guest')->except('logout');
  }
  public function login(Request $request)
  {
    $field = 'user_id';
    $request->merge([$field => $request->email]);
    // $request->merge(['user'=> $request->email]);
    // dd($request->only('user', 'password'));
    if (auth()->attempt($request->only($field, 'password'))) {
      Session::put('user_id', $request->email);
      return redirect('/mypage');
    }
    return redirect('/')->withErrors([
      'message' => 'ユーザーIDまたは、パスワードが間違いました。ご確認ください。',
    ]);
  }
  public function user_id() {
    return "user_id";
    
  }
}
