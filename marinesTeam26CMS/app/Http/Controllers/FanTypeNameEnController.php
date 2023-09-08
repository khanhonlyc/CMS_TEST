<?php
namespace App\Http\Controllers;
use App\Models\FanTypeNameEn;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class FanTypeNameEnController extends Controller
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
    $allrequest = $request->all();
    $ranks = FanTypeNameEn::with('fantypecodes');
    $permission = Auth::user()->permission;
    if (!empty($allrequest) && isset($allrequest['createUpdateAt'])) {
      $createUpdateAt = array_key_exists('createUpdateAt', $allrequest) ? $allrequest['createUpdateAt'] : null;
      $descAsc = array_key_exists('descAsc', $allrequest) ? $allrequest['descAsc'] : null;
      $ranks = $ranks->orderBy($createUpdateAt, $descAsc);
    }
    $ranks = $ranks->paginate(20);
    return view('page.fan-type')->with(compact('ranks', 'permission', 'allrequest'));
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) // ok
  {
    $allrequest = $request->all();
    $user_id = $request->session()->get('user_id', null);
    $user = User::where('user_id', $user_id)->firstOrFail();
    $frm = new FanTypeNameEn();
    $now = Carbon::now()->toDateTimeString();
    $frm->fantypecode = $allrequest['fantypecode'];
    $frm->fantypename = $allrequest['fantypename'];
    $frm->fantypenameen = $allrequest['fantypenameen'];
    $frm->created_at = $now;
    $frm->updated_at = $now;
    $frm->create_user = $user->user_name;
    $ranks = FanTypeNameEn::orderBy("id", "DESC")->paginate(20);
    $frm->save();
    $user_id = $request->session()->get('user_id', null);
    $permission = Auth::user()->permission;
    Session::put('store', 'store');
    return redirect()->route('fan-type.index');
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\FanTypeNameEn  $FanTypeNameEn
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $allrequest = $request->all();
    $ranks = FanTypeNameEn::paginate(20);
    $now = Carbon::now()->toDateTimeString();
    $frm = FanTypeNameEn::find($id);
    $user_id = $request->session()->get('user_id', null);
    $user = User::where('user_id', $user_id)->firstOrFail();
    $frm->fantypecode = $allrequest['fantypecode'];
    $frm->fantypename = $allrequest['fantypename'];
    $frm->fantypenameen = $allrequest['fantypenameen'];
    $frm->update_user = $user->user_name;
    $permission = Auth::user()->permission;
    if ($permission == "1" && array_key_exists("checkper", $allrequest) && $allrequest['checkper'] == 'on') {
      $frm->deleted_at = Carbon::now();
      $frm->delete_user = Auth::user()->user_name;
    }
    $frm->save();
    return redirect()->back();
  }
}
