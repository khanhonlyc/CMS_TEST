<?php
namespace App\Http\Controllers;
use App\Models\EditPermission;
use App\Models\FanTypeNameEn;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
class EditPermissionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $store = Session::get('store');
    if ($store) {
      $ranks = FanTypeNameEn::orderBy("id", "DESC")->paginate(5);
    } else {
      $ranks = FanTypeNameEn::paginate(5);
    }
    $user_id = $request->session()->get('user_id', null);
    $permission = User::where('user_id', $user_id)->firstOrFail()->permission;
    return view('pages.edit-permission')->with(compact('ranks', 'permission'));
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
    //
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\EditPermission  $editPermission
   * @return \Illuminate\Http\Response
   */
  public function show(EditPermission $editPermission)
  {
    //
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\EditPermission  $editPermission
   * @return \Illuminate\Http\Response
   */
  public function edit(EditPermission $editPermission)
  {
    //
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\EditPermission  $editPermission
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, EditPermission $editPermission)
  {
    //
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\EditPermission  $editPermission
   * @return \Illuminate\Http\Response
   */
  public function destroy(EditPermission $editPermission)
  {
    //
  }
}
