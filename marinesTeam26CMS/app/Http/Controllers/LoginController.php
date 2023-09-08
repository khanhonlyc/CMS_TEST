<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class LoginController extends Controller
{
  public function index() {
    if(is_null(Session::get('user_id'))) {
      return view('auth.login');
    }else {
      return redirect()->route('mypage');
    }
  }
}
