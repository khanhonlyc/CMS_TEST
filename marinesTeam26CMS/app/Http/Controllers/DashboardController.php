<?php
namespace App\Http\Controllers;
use App\Models\Dashboard;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function mypage()
  {
    return view('page.mypage');
  }
}
