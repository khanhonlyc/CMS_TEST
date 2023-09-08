<?php
namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;
use Carbon\Carbon;
use App\Models\Tag;
class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    return redirect()->route('home');
  }
  public function dashboard(Request $request)
  {
    $user_id = $request->session()->get('user_id', null);
    $permission = User::where('user_id', $user_id)->firstOrFail()->permission;
    return view('pages.dashboard', compact('permission'));
  }
  public function top(Request $request)
  {
    $datas = [];
    $keyword = $request->input('keyword');
    $membership = $request->input('membership');
    $status = $request->input('status');
    if (!$membership) {
      $membership = [];
    }
    $text1 = implode(' ', $membership);
    if (!$status) {
      $status = [];
    }
    $text2 = implode(' ', $status);
    $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
      ->where('fan_type_code', 'LIKE', "%{$text1}%")
      ->where('status', 'LIKE', "%{$text2}%")
      ->paginate(6);
    return view('pages.top-page')->with(compact('banners', 'datas'));
  }
  function fetch_banners(Request $request)
  {
    if ($request->ajax()) {
      $datas = $request->all();
      $keyword = array_key_exists("keyword", $datas) ? $datas['keyword'] : null;
      $membership = array_key_exists("membership", $datas) ? $datas['membership'] : null;
      $status = array_key_exists("status", $datas) ? $datas['status'] : null;
      $submitv = array_key_exists("submitv", $datas) ? $datas['submitv'] : null;
      if (!$membership) {
        $membership = [];
      }
      $text1 = implode(' ', $membership);
      if (!$status) {
        $status = [];
      }
      $text2 = implode(' ', $status);
      $createupdateat = array_key_exists("createupdateat", $datas) ? $datas['createupdateat'] : "id";
      $descAsc = array_key_exists("descAsc", $datas) ? $datas['descAsc'] : "asc";
      // ==
      if ($submitv) {
        if ($createupdateat == 'id') {
          $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
            ->where('fan_type_code', 'LIKE', "%{$text1}%")
            ->where('status', 'LIKE', "%{$text2}%")
            ->orderBy('id', $descAsc)
            ->paginate(6);
        } elseif ($createupdateat == 'create_at') {
          $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
            ->where('fan_type_code', 'LIKE', "%{$text1}%")
            ->where('status', 'LIKE', "%{$text2}%")
            ->orderBy('id', $descAsc)
            ->paginate(6);
        } elseif ($createupdateat == 'update_at') {
          $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
            ->where('fan_type_code', 'LIKE', "%{$text1}%")
            ->where('status', 'LIKE', "%{$text2}%")
            ->orderBy('id', $descAsc)
            ->paginate(6);
        }
      } else {
        $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
          ->where('fan_type_code', 'LIKE', "%{$text1}%")
          ->where('status', 'LIKE', "%{$text2}%")
          ->paginate(6);
      }
      if ($submitv) {
        return response()->json(array('msg' => $banners), 200);
      } else {
        return view('data', compact('banners', 'datas'));
      }
    }
  }
  public function top_page_ajax(Request $request)
  {
    $datas = $request->all();
    $keyword = array_key_exists("keyword", $datas) ? $datas['keyword'] : null;
    $membership = array_key_exists("membership", $datas) ? $datas['membership'] : null;
    $status = array_key_exists("status", $datas) ? $datas['status'] : null;
    $submitv = array_key_exists("submitv", $datas) ? $datas['submitv'] : null;
    if (!$membership) {
      $membership = [];
    }
    $text1 = implode(' ', $membership);
    if (!$status) {
      $status = [];
    }
    $text2 = implode(' ', $status);
    $createupdateat = array_key_exists("createupdateat", $datas) ? $datas['createupdateat'] : "id";
    $descAsc = array_key_exists("descAsc", $datas) ? $datas['descAsc'] : "asc";
    if ($submitv) {
      if ($createupdateat == 'id') {
        $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
          ->where('fan_type_code', 'LIKE', "%{$text1}%")
          ->where('status', 'LIKE', "%{$text2}%")
          ->orderBy('id', $descAsc)
          ->paginate(6);
      } elseif ($createupdateat == 'create_at') {
        $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
          ->where('fan_type_code', 'LIKE', "%{$text1}%")
          ->where('status', 'LIKE', "%{$text2}%")
          ->orderBy('id', $descAsc)
          ->paginate(6);
      } elseif ($createupdateat == 'update_at') {
        $banners = Banner::where('title', 'LIKE', "%{$keyword}%")
          ->where('fan_type_code', 'LIKE', "%{$text1}%")
          ->where('status', 'LIKE', "%{$text2}%")
          ->orderBy('id', $descAsc)
          ->paginate(6);
      }
    } else {
      $banners = RowsingLog::where('title', 'LIKE', "%{$keyword}%")
        ->where('fan_type_code', 'LIKE', "%{$text1}%")
        ->where('status', 'LIKE', "%{$text2}%")
        ->paginate(6);
    }
    if ($submitv) {
      return response()->json(array('msg' => $banners), 200);
    } else {
      return view('pages.top-page')->with(compact('banners', 'datas'));
    }
  }
  public function top_management_duplicator(Request $request)
  {
    $datas = $request->all();
    return view('pages.top-page-management-duplicate');
  }
  public function top_management_copy()
  {
    return view('pages.top-page-management-copy');
  }
  public function user_management()
  {
    return view('pages.user-management');
  }
  public function home()
  {
    return view('home');
  }
}
