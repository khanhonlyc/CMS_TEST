<?php
namespace App\Http\Controllers;
use App\Models\Permission;
use App\Models\FanTypeNameEn;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
class UserController extends Controller
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
    $authorities = Permission::orderBy('permission_id', "ASC")->get();
    $user_id = $request->session()->get('user_id', null);
    $permission = Auth::user()->permission;
    $users = User::with('permissionname');
    if (!empty($allrequest) && isset($allrequest['createUpdateAt'])) {
      $createUpdateAt = array_key_exists('createUpdateAt', $allrequest) ? $allrequest['createUpdateAt'] : null;
      $descAsc = array_key_exists('descAsc', $allrequest) ? $allrequest['descAsc'] : null;
      $users = $users->orderBy($createUpdateAt, $descAsc);
    }
    $users = $users->paginate(20);
    return view('page.user')->with(compact('authorities', 'permission', 'users', 'allrequest'));
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
    $permission = new Permission();
    $datas = $request->all();
    $now = Carbon::now()->toDateTimeString();
    $count = User::count();
    $usern = new User();
    $user_id = $request->session()->get('user_id', null);
    $user = User::where('user_id', $user_id)->firstOrFail();
    if(!empty($datas['password'])) {
      $usern->password = Hash::make($datas['password']);
    }
    $usern->user_id = $datas['id'];
    $usern->user_name = $datas['name'];
    $usern->permission = $datas['authority'];
    $usern->created_at = $now;
    $usern->updated_at = $now;
    $usern->update_user = Auth::user()->user_name;
    $usern->create_user = Auth::user()->user_name;
    $usern->sort_no = $count + 1;
    $usern->deleted_at = null;
    $usern->save();
    return redirect()->back()->with('store', 'store');
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Permission  $Permission
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $now = Carbon::now()->toDateTimeString();
    $datas = $request->all();
    $usern = User::find($id);
    $usern->user_id = $datas['id'];
    $usern->password = Hash::make($datas['password']);
    $usern->permission = $datas['authority'];
    $usern->user_name = $datas['name'];
    $usern->updated_at = $now;
    $usern->update_user = Auth::user()->user_name;
    $usern->deleted_at = null;
    $permission = Auth::user()->permission;
    if ($permission == "1" && array_key_exists("checkper", $datas) && $datas['checkper'] == 'on') {
      $usern->deleted_at = Carbon::now();
      $usern->delete_user = Auth::user()->user_name;
    }
    $usern->save();
    return redirect()->back();
  }
}
