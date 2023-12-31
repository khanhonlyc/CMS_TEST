<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('register');
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $now = Carbon::now()->toDateTimeString();
    $alldatas = $request->all();
    $count = User::count();
    $password = $alldatas['password'];
    $user_name = $alldatas['user_name'];
    $usern = new User();
    $usern->user_id = $alldatas['user_id'];
    $usern->user_name = $alldatas['user_name'];
    $usern->password = Hash::make($alldatas['password']);
    $usern->permission = 3;
    $usern->created_at = $now;
    $usern->updated_at = $now;
    $usern->update_user = $alldatas['user_name'];
    $usern->create_user = $alldatas['user_name'];
    $usern->sort_no = $count + 1;
    Session::put('user_id', $alldatas['user_id']);
    $usern->save();
    return redirect()->route('login');
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    //
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    //
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    //
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    //
  }
}
