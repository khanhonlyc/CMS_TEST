<?php
namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class TagController extends Controller
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
    if (array_key_exists("createUpdateAt", $allrequest)) {
      $createUpdateAt = $allrequest['createUpdateAt'];
      $descAsc = $allrequest['descAsc'];
      $datas = Tag::orderBy($createUpdateAt, $descAsc);
    }
    $datas = isset($datas) ? $datas->paginate(20) : Tag::paginate(20);
    $permission = Auth::user()->permission;
    return view('page.tag')->with(compact('datas', 'permission', 'allrequest'));
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
    $validator = Validator::make($request->all(),
    [
      'tag_id' => [
        'required',
        'integer',
        Rule::unique('tag')->whereNull('deleted_at')
      ],
      'tag_name' => [
        'required',
        Rule::unique('tag')->whereNull('deleted_at')
      ],
    ],[
      'tag_id.required' => "タグIDが入力されていません。タグIDを入力してください",
      'tag_id.integer' => "タグIDは整数でなければなりません。",
      'tag_id.unique' => "入力されたタグIDは既に登録されています。別のタグIDを入力ください。",
      'tag_name.required' => "表示タグ名称が入力されていません。表示タグ名称を入力してください。",
      'tag_name.unique' => "入力された表示タグ名称は既に登録されています。別の表示タグ名称を入力ください。",
    ]);
    $allrequest = $request->all();
    $tag = new Tag();
    $tag->tag_id = $allrequest['tag_id'];
    $tag->tag_name = $allrequest['tag_name'];
    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()->all()]);
    }
    $tag->created_at = Carbon::now();
    $tag->create_user = Auth::user()->user_name;
    $tag->save();
    return redirect()->route('tag.index');
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $tag)
  {
    $validator = Validator::make($request->all(),
    [
      'tag_id' => [
        'required',
        'integer',
        Rule::unique('tag')->ignore($tag, 'id')->whereNull('deleted_at')
      ],
      'tag_name' => [
        'required',
        Rule::unique('tag')->ignore($tag, 'id')->whereNull('deleted_at')
      ],
    ],[
      'tag_id.required' => "タグIDが入力されていません。タグIDを入力してください",
      'tag_id.integer' => "タグIDは整数でなければなりません。",
      'tag_id.unique' => "入力されたタグIDは既に登録されています。別のタグIDを入力ください。",
      'tag_name.required' => "表示タグ名称が入力されていません。表示タグ名称を入力してください。",
      'tag_name.unique' => "入力された表示タグ名称は既に登録されています。別の表示タグ名称を入力ください。",
    ]);
    $tag = Tag::find($tag);
    $datas = $request->all();
    $tag->tag_id = $datas['tag_id'];
    $tag->tag_name = $datas['tag_name'];
    $tag->updated_at = Carbon::now();
    $tag->update_user = Auth::user()->user_name;
    $permission = Auth::user()->permission;
    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()->all()]);
    }
    if ($permission == "1" && array_key_exists("checkper", $datas) && $datas['checkper'] == 'on') {
      $tag->deleted_at = Carbon::now();
      $tag->delete_user = Auth::user()->user_name;
    }
    $tag->save();
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tag $tag)
  {
    //
  }
}
