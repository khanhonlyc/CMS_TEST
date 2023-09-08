<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Movie;
use App\Models\User;
use Carbon\Carbon;
class ContentRegistration extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function content_registration(Request $request)
  {
    $datas = $request->all();
    $tags = Tag::get()->pluck('tag_name', 'tag_id');
    $user_id = $request->session()->get('user_id', null);
    $permission = User::where('user_id', $user_id)->firstOrFail()->permission;
    return view('pages.content-registration')->with(compact('tags','permission'));
  }
  public function content_registration_ajax(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:22048',
    ],
    [
      'title.required' => 'このフィールドはまだ入力されません。ご確認ください。',
      'image.required' => '写真をアップロードしてください。',
    ]
  );
    $user_id = $request->session()->get('user_id', null);
    $permission = User::where('user_id', $user_id)->firstOrFail()->permission;
    $movie = new Movie();
    $now = Carbon::now()->toDateTimeString();
    $datas = $request->all();
    $movie->title = $datas['title'];
    $movie->movie_type_code = $datas['live'];
    $imageName = time() . '.' . $request->image->extension();
    $movie->thumbnail_url = $imageName;
    $movie->sauce = $datas['iframe'];
    $membership = array_key_exists("membership", $datas) ? $datas['membership'] : null;
    $movie->fan_type_code = implode(',', $membership);
    $movie->publish_start = $datas['datepicker'];
    $movie->publish_end = $datas['datepicker2'];
    $movie->status = $datas['status'];
    $request->image->move(public_path('images'), $imageName);
    $movie->created_at = $now;
    $movie->updated_at = $now;
    $movie->deleted_at = $now;
    if($permission == "1" && array_key_exists("checkper", $datas)) {
      $movie->delete_flg = $datas['checkper'] == "on" ? 1 : 0;
    }else {
      $movie->delete_flg = 0;
    }
    $movie->save();
    $idmove = $movie->id;
    $movie = Movie::find($idmove);
    $datatags = $datas['tags'];
    $movie->tags()->sync($datatags);
    $tags = Tag::get()->pluck('tag_name', 'tag_id');
    return view('pages.content-registration')->with(compact('tags','permission'));
  }
}
