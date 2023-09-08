<?php
namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Movie;
use App\Models\User;
use App\Models\FanTypeNameEn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogActivity as LogActivityHelp;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use File;
use Storage;
use Illuminate\Http\UploadedFile;
class MovieController extends Controller
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
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $datas = $request->all();
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $tags = Tag::get()->pluck('tag_name', 'id');
    $categories = Movie::groupBy('movie_type_code')->get();
    $keyword = array_key_exists("keyword", $datas) ? $datas['keyword'] : '';
    $typeCode = array_key_exists("videoCategories", $datas) ? $datas['videoCategories'] : null;
    $tagsSearch = array_key_exists("tag", $datas) ? $datas['tag'] : [];
    $status = array_key_exists("status", $datas) ? $datas['status'] : [0, 1];
    $createupdateat = array_key_exists("sortBy", $datas) ? $datas['sortBy'] : "id";
    $descAsc = array_key_exists("sortType", $datas) ? $datas['sortType'] : "asc";
    $movies = Movie::where('title', 'LIKE', "%{$keyword}%")->with('tags');
    if (count($tagsSearch)) {
      $movies = $movies->whereHas('tags', function ($q) use ($tagsSearch) {
        if (count($tagsSearch)) {
          $q->whereIn('tag.tag_id', $tagsSearch);
        }
      });
    }
    // $movies1 = DB::table('movie')->where('status', 'like', $status)->orderBy('created_at', 'desc')->paginate(5);
    // $movies1 = Movie::where('status', 'like', $status)->orderBy('created_at', 'desc')->paginate(5);
    // return $movies1;
    if ($typeCode) {
      $movies = $movies->where('movie_type_code', $typeCode);
    }
    $movies = $movies->paginate(20);
    $fantynameen = FanTypeNameEn::all();
    return view('page.content-list')->with(compact('movies', 'categories', 'datas', 'tags', 'request', 'fantynameen'));
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $tags = Tag::get()->pluck('tag_name', 'id');
    $fantynameen = FanTypeNameEn::all();
    return view('page.content-registration')->with(compact('tags', 'fantynameen'));
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $host = request()->getHttpHost();
    $host = "https://" . $host;
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $request->validate(
      [
        'title' => 'required',
        'live' => 'required',
        'iframe' => 'required',
        'membership' => 'required',
        'datepicker' => 'required',
        'status' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:22048',
      ],
      [
        'title.required' => 'タイトルが入力されません。タイトルを入力してください。',
        'iframe.required' => '内容が入力されていません。内容を入力してください。',
        'membership.required' => '会員種別が選択されていません。会員種別を選択してください。',
        'tags.required' => 'タグ・キーワードが入力されていません。タグ・キーワードを入力してください。',
        'image.image' => 'アップロードしたファイルが画像ではありません。画像をアップロードしてください。',
        'image.mimes' => 'アップロードした画像のフォーマットが正しくありません。jpeg・png・jpg・gif・svgの拡張子のファイルをアップロードしてください。',
        'image.max' => '画像のファイルサイズが最大値を超えました。再度画像をアップロードしてください。',
        'datepicker.required' => '公開日時が選択されていません。公開日を選択してください。',
      ]
    );
    $permission = Auth::user()->permission;
    $movie = new Movie();
    $now = Carbon::now()->toDateTimeString();
    $datas = $request->all();
    $movie->title = $datas['title'];
    $movie->movie_type_code = $datas['live'];
    if (env('SFTP_HOST_FIRST', null)) {
      $filesystem1 = Storage::disk('sftp1');
      $filesystem1->getDriver()->getAdapter()->setDirectoryPerm(0755);
    }
    if (env('SFTP_HOST_SECOND', null)) {
      $filesystem2 = Storage::disk('sftp2');
      $filesystem2->getDriver()->getAdapter()->setDirectoryPerm(0755);
    }
    if (isset($datas['image'])) {
      $imageName = time() . '.' . $request->image->extension();
      $movie->thumbnail_url = "/storage/images/" . $imageName;
      $request->file('image')->storeAs('images', $imageName, 'public');
      //Put file to Storage SFTP
      if (env('SFTP_HOST_FIRST', null)) {
        $filesystem1->putFileAs('/app/public/images', $request->file('image'), $imageName);
      }
      if (env('SFTP_HOST_SECOND', null)) {
        $filesystem2->putFileAs('/app/public/images', $request->file('image'), $imageName);
      }
    } else {
      if (isset($datas['imageAfter']) && $datas['imageAfter'] != null) {
        $url = $datas['imageAfter'];
        $name = substr($url, strrpos($url, '/') + 1);
        $namechange = time() . $name;
        $destinationPath = storage_path() . '/app/public/images';
        $trimImg = trim(str_replace($host . "/", "", $url));
        $imagePath = public_path($trimImg);
        if (File::exists($imagePath)) {
          File::copy(base_path() . "/storage/app/public/images/" . $name, base_path() . "/storage/app/public/images/" . $namechange);
          //Put file to Storage SFTP
          if (env('SFTP_HOST_FIRST', null)) {
            $filesystem1->putFileAs('/app/public/images', File::get(storage_path('/app/public/images/' . $name)), $namechange);
          }
          if (env('SFTP_HOST_SECOND', null)) {
            $filesystem2->putFileAs('/app/public/images', File::get(storage_path('/app/public/images/' . $name)), $namechange);
          }
        }
        $movie->thumbnail_url = "/storage/images/" . $namechange;
      }
    }
    $movie->sauce = $datas['iframe'];
    $membership = array_key_exists("membership", $datas) ? $datas['membership'] : null;
    $movie->fan_type_code = implode(',', $membership);
    $movie->publish_start = $datas['datepicker'];
    $movie->publish_end = $datas['datepicker2'];
    $movie->status = $datas['status'];
    $movie->created_at = $now;
    $movie->updated_at = $now;
    $movie->create_user = Auth::user()->user_name;
    $movie->update_user = Auth::user()->user_name;
    $movie->save();
    if (isset($datas['tags']) && count($datas['tags'])) {
      $movie->tags()->sync($datas['tags']);
    }
    return redirect()->route('content.index');
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    // LogActivityHelp::addToLog($userid, $username);
    $tags = Tag::get()->pluck('tag_name', 'id');
    $movie = Movie::where('id', $id)->with('tags')->first();
    $permission = Auth::user()->permission;
    $fantynameen = FanTypeNameEn::all();
    return view('page.content-edit')->with(compact('tags', 'movie', 'permission', 'fantynameen'));
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate(
      [
        'title' => 'required',
        'live' => 'required',
        'iframe' => 'required',
        'membership' => 'required',
        'datepicker' => 'required',
        'status' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:22048',
      ],
      [
        'title.required' => 'タイトルが入力されません。タイトルを入力してください。',
        'iframe.required' => '内容が入力されていません。内容を入力してください。',
        'membership.required' => '会員種別が選択されていません。会員種別を選択してください。',
        'tags.required' => 'タグ・キーワードが入力されていません。タグ・キーワードを入力してください。',
        'image.image' => 'アップロードしたファイルが画像ではありません。画像をアップロードしてください。',
        'image.mimes' => 'アップロードした画像のフォーマットが正しくありません。jpeg・png・jpg・gif・svgの拡張子のファイルをアップロードしてください。',
        'image.max' => '画像のファイルサイズが最大値を超えました。再度画像をアップロードしてください。',
        'datepicker.required' => '公開日時が選択されていません。公開日を選択してください。',
      ]
    );
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $host = request()->getHttpHost();
    $host = "https://" . $host;
    $permission = Auth::user()->permission;
    $movie = Movie::find($id);
    $now = Carbon::now()->toDateTimeString();
    $datas = $request->all();
    $movie->title = $datas['title'];
    $movie->movie_type_code = $datas['live'];
    $movie->sauce = $datas['iframe'];
    $membership = array_key_exists("membership", $datas) ? $datas['membership'] : null;
    $movie->fan_type_code = implode(',', $membership);
    $movie->publish_start = $datas['datepicker'];
    $movie->publish_end = $datas['datepicker2'];
    $movie->status = $datas['status'];
    $imageName = "";
    if (isset($datas['imageBefore']) && $datas['imageBefore'] != "") {
      $trimImg = trim(str_replace($host . "/", "", $movie->thumbnail_url));
      $imagePath = public_path($trimImg);
      $movie->thumbnail_url = $datas['imageBefore'];
    }
    $movie->updated_at = $now;
    $movie->update_user = Auth::user()->user_name;
    if ($permission == "1" && array_key_exists("checkper", $datas)) {
      $movie->deleted_at = $now;
      $movie->delete_user = Auth::user()->user_name;
    }
    $movie->save();
    if (isset($datas['tags']) && count($datas['tags'])) {
      $movie->tags()->sync($datas['tags']);
    }
    return redirect()->route('content.index');
  }
  public function copy(Request $request)
  {
    $getData = $request->all();
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $tags = Tag::get()->pluck('tag_name', 'id');
    $movieId = null;
    foreach ($getData['datas'] as $item) {
      if ($item['name'] === 'movie_id') {
            $movieId = $item['value'];
            break;
      }
    }  
    $movie = Movie::where('id', $movieId)->with('tags')->first();
    $permission = Auth::user()->permission;
    $fantynameen = FanTypeNameEn::all();
    return view('page.content-copy', compact('getData', 'movie', 'permission', 'tags', 'fantynameen'));
  }
  public function uploadimage(Request $request)
  {
    try {
      $request->validate([
        'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
      $host = request()->getHttpHost();
      $host = "https://" . $host;
      $data = array();
      if (env('SFTP_HOST_FIRST', null)) {
        $filesystem1 = Storage::disk('sftp1');
        $filesystem1->getDriver()->getAdapter()->setDirectoryPerm(0755);
      }
      if (env('SFTP_HOST_SECOND', null)) {
        $filesystem2 = Storage::disk('sftp2');
        $filesystem2->getDriver()->getAdapter()->setDirectoryPerm(0755);
      }
      if ($request->hasFile('file')) {
        $image = $request->file('file');
        $getName = $image->getClientOriginalName();
        $imageName = time() . $getName;
        $destinationPath = storage_path() . '/app/public/images';
        //Put file to Storage SFTP
        if (env('SFTP_HOST_FIRST', null)) {
          $filesystem1->putFileAs('/app/public/images', $request->file('file'), $imageName);
        }
        if (env('SFTP_HOST_SECOND', null)) {
          $filesystem2->putFileAs('/app/public/images', $request->file('file'), $imageName);
        }
        $image->move($destinationPath, $imageName);
        $data['imgName'] = $imageName;
        $data['imghost'] = "/storage/images/" . $imageName;
      }
      return response()->json($data);
    } catch (Exception $e) {
      Log::warning($e->getMessage());
    }
  }
}
