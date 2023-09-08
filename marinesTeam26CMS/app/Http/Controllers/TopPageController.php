<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\FanTypeNameEn;
use File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogActivity as LogActivityHelp;
use Illuminate\Support\Facades\Gate;
use Storage;
class TopPageController extends Controller
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
  public function top_page_type(Request $request, $id)
  {
    $datas = $request->all();
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $keyword = array_key_exists("keyword", $datas) ? $datas['keyword'] : '';
    $membership = array_key_exists("membership", $datas) ? $datas['membership'] : [];
    $createUpdateAt = isset($datas['createUpdateAt']) ? $datas['createUpdateAt'] : 'id';
    $status = array_key_exists("status", $datas) ? $datas['status'] : [0, 1];
    $descAsc = array_key_exists("descAsc", $datas) ? $datas['descAsc'] : "asc";
    $banners = Banner::where('banner_type_code', $id)->where('title', 'LIKE', "%{$keyword}%")->with('fantypenameen');
    if (count($membership)) {
      $banners = $banners->whereHas('fantypenameen', function ($q) use ($membership) {
        $q->whereIn('fan_type_name_en.id', $membership);
      });
    }
    $banners = $banners->whereIn('status', $status)->orderBy($createUpdateAt, $descAsc);
    $banners = $banners->paginate(20);
    $fantynameen = FanTypeNameEn::all();
    return view('top-page.index')->with(compact('banners', 'datas', 'id', 'fantynameen'));
  }
  public function top_page_type_edit_id_get(Request $request, $type, $id)
  {
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $banner = Banner::where('id', $id)->with('fantypenameen')->first();
    $permission = Auth::user()->permission;
    $fantynameen = FanTypeNameEn::all();
    $old_data = $request->session()->get('_old_input',null);
    //dd($old_data);
    return view('top-page.show', compact('type', 'id', 'banner', 'old_data', 'permission','fantynameen'));
  }
  public function top_page_type_edit_id_put(Request $request, $type, $id)
  {
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $request->validate(
      [
        'title' => 'required',
        'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:22048',
        'sort' => 'required|numeric|digits_between:1,10',
        'url' => 'required',
        'select' => 'required',
        'checks' => 'required',
        'time1' => 'required|before:time2',
        'time2' => 'required',
        'status' => 'required'
      ],
      [
        'title.required' => '管理名称は必須です。入力してください。',
        'file.max' => '画像登録は必須です。画像をアップロードしてください。',
        'sort.required' => '表示順は必須です。表示順を入力してください。。',
        'sort.numeric' => '表示順は数字で入力してください。',
        'sort.digits_between' => '表示順の最大桁数は10桁までです。',
        'url.required' => '遷移先は必須です。遷移先を入力してください。',
        'select.required' => 'リンク設定は必須です。選択してください。',
        'checks.required' => '会員種別は必須です。選択してください。',
        'time1.required' => '開始日時は必須です。入力してください。',
        'time1.before' => '開始日時が終了日より後に設定されています。終了日より前に設定してください。',
        'time2.required' => '終了日時は必須です。入力してください。',
        'status.required' => '公開・非公開を選択してください。',
      ]
    );
    $banner = Banner::find($id);
    $host = request()->getHttpHost();
    $host = "https://" . $host;
    $permission = Auth::user()->permission;
    $now = Carbon::now()->toDateTimeString();
    $request->validate([
      'title' => 'required'
    ]);
    $imageName = "";
    $datas = $request->all();
    if (isset($datas['imageBefore']) && $datas['imageBefore'] !="") {
      $trimImg = trim(str_replace($host."/","",$banner->image_url));
      $imagePath = public_path($trimImg);
      $banner->image_url = $datas['imageBefore'];
    }
    $banner->title = $datas['title'];
    $banner->sort_no = $datas['sort'];
    $banner->url = $datas['url'];
    $banner->target = $datas['select'] == 0 ? '_blank' : '_self';
    $banner->publish_start = $datas['time1'];
    $banner->publish_end = $datas['time2'];
    $banner->status = $datas['status'];
    if ($permission == "1" && array_key_exists("checkper", $datas) && $datas['checkper'] == 'on') {
      $banner->deleted_at = Carbon::now();
    } else if ($permission == "1" && !array_key_exists("checkper", $datas)) {
      $banner->deleted_at = null;
    }
    $banner->updated_at = $now;
    $banner->save();
    $datachecks = $datas['checks'];
    if (count($datachecks)) {
      $banner->fantypenameen()->sync($datachecks);
    }
    $success = 'You have successfully update image ' . $imageName;
    return redirect()->route('top-page-type', $type)->with('message', 'State saved correctly!!!');
  }
  public function top_page_type_create_get(Request $request, $type)
  {
    $fantynameen = FanTypeNameEn::all();
    $old_data = $request->session()->get('_old_input',null);
    return view('top-page.create')->with(compact('type', 'old_data', 'fantynameen'));
  }
  public function top_page_type_create_post(Request $request)
  {
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    // LogActivityHelp::addToLog($userid, $username);
    $banner = new Banner();
    $host = request()->getHttpHost();
    $host = "https://" . $host;
    $datas = $request->all();
    if(isset($datas['image'])) {
      $imageR = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:22048';
    }else {
      $imageR = '';
    }
    $request->validate(
      [
        'title' => 'required',
        'image' => $imageR,
        'sort' => 'required|numeric|digits_between:1,10',
        'url' => 'required',
        'select' => 'required',
        'checks' => 'required',
        'time1' => 'required|before:time2',
        'time2' => 'required',
        'status' => 'required'
      ],
      [
        'title.required' => '管理名称は必須です。入力してください。',
        'image.max' => '画像登録は必須です。画像をアップロードしてください。',
        'sort.required' => '表示順は必須です。表示順を入力してください。。',
        'sort.numeric' => '表示順は数字で入力してください。',
        'sort.digits_between' => '表示順の最大桁数は10桁までです。',
        'url.required' => '遷移先は必須です。遷移先を入力してください。',
        'select.required' => 'リンク設定は必須です。選択してください。',
        'checks.required' => '会員種別は必須です。選択してください。',
        'time1.required' => '開始日時は必須です。入力してください。',
        'time1.before' => '開始日時が終了日より後に設定されています。終了日より前に設定してください。',
        'time2.required' => '終了日時は必須です。入力してください。',
        'status.required' => '公開・非公開を選択してください。',
      ]
    );
    $now = Carbon::now()->toDateTimeString();
    $banner->banner_type_code = $datas['id'];
    $banner->sort_no = $datas['sort'];
    $banner->title = $datas['title'];
    $banner->url = $datas['url'];
    $banner->target = $datas['select'] == 0 ? '_blank' : '_self';
    $banner->publish_start = $datas['time1'];
    $banner->publish_end = $datas['time2'];
    $banner->status = $datas['status'];
    $banner->create_user = Auth::user()->user_name;
    $banner->created_at = $now;
    $banner->updated_at = $now;
    if(env('SFTP_HOST_FIRST', null)) {
      $filesystem1 = Storage::disk('sftp1');
      $filesystem1->getDriver()->getAdapter()->setDirectoryPerm(0755);
    }
    if(env('SFTP_HOST_SECOND', null)) {
      $filesystem2 = Storage::disk('sftp2');
      $filesystem2->getDriver()->getAdapter()->setDirectoryPerm(0755);
    }
     if (isset($datas['image'])) {
        $imageName = time() . '.' . $request->image->extension();
        $banner->image_url = "/storage/images/" . $imageName;
        $request->file('image')->storeAs('images', $imageName, 'public');
        //Put file to Storage SFTP
        if(env('SFTP_HOST_FIRST', null)) {
          $filesystem1->putFileAs('/app/public/images', $request->file('image'), $imageName);
        }
        if(env('SFTP_HOST_SECOND', null)) {
          $filesystem2->putFileAs('/app/public/images', $request->file('image'), $imageName);
        }
     }else {
        if (isset($datas['imageAfter']) && $datas['imageAfter'] != null) {
          $url = $datas['imageAfter'];
          $name = substr($url, strrpos($url, '/') + 1);
          $namechange = time() . $name;
          $destinationPath = storage_path() . '/app/public/images';
          $trimImg = trim(str_replace($host."/","",$url));
          $imagePath = public_path($trimImg);
          if (File::exists($imagePath)) {
            File::copy(base_path() . "/storage/app/public/images/" . $name, base_path() . "/storage/app/public/images/" . $namechange);
            //Put file to Storage SFTP
            if(env('SFTP_HOST_FIRST', null)) {
              $filesystem1->putFileAs('/app/public/images', File::get(storage_path('/app/public/images/'.$name)), $namechange);
            }
            if(env('SFTP_HOST_SECOND', null)) {
              $filesystem2->putFileAs('/app/public/images', File::get(storage_path('/app/public/images/'.$name)), $namechange);
            }
          }
          $banner->image_url = "/storage/images/" . $namechange;
        }
     }
    $banner->save();
    $datachecks = $datas['checks'];
    if (count($datachecks)) {
      $banner->fantypenameen()->attach($datachecks);
    }
    $old_data = $request->session()->get('_old_input',null);
    return redirect()->route('top-page-type', $datas['id'])->with('message', 'old_data', 'State saved correctly!!!');
  }
  public function top_page_type_copy_get(Request $request, $type)
  {
    //dd($request);
    $userid = Auth::user()->user_id;
    $username = Auth::user()->user_name;
    $permission = Auth::user()->permission;
    $getData = $request->all();
    $fantynameen = FanTypeNameEn::all();
    $old_data = $request->session()->get('_old_input',null);
    if($old_data != null)
    {
      foreach($getData['datas'] as $key=>$val)
      {
        if($val['name'] != 'checks[]')
        {
          if(isset($old_data[$val['name']]))
          {
            $getData['datas'][$key]['value'] = $old_data[$val['name']];
          }
          else
          {
            unset($getData['datas'][$key]);  
          }
        }
        else
        {
          unset($getData['datas'][$key]);
        }
      }
      if(isset($old_data['checks'])) {
        foreach($old_data['checks'] as $item)
        {
          array_push($getData['datas'], ["name"=>"checks[]","value"=>$item]);
        }
      }
    }
    return view('top-page.copy', compact('type', 'getData', 'old_data', 'permission','fantynameen'));
  }
}
