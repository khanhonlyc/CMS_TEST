<?php
namespace App\Http\Controllers;
use App\Models\LogQuery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RowsingLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LogQueryController extends Controller
{
  public function index(Request $request)
  {
    $datas = $request->all();
    $keyword = $request->input('keyword') ?? '';
    $datepicker = $request->input('datepicker');
    $datepicker2 = $request->input('datepicker2');
    $sortBy = array_key_exists("sortBy", $datas) ? $datas['sortBy'] : "id";
    $sortType = array_key_exists("sortType", $datas) ? $datas['sortType'] : "asc";
    $logs = RowsingLog::where('marines_id', 'LIKE', "%{$keyword}%");
    if ($datepicker) {
      $logs = $logs->where('regist_dt', '>=', $datepicker);
    }
    if ($datepicker2) {
      $logs = $logs->where('regist_dt', '<=', $datepicker2);
    }
    $logs = $logs->orderBy($sortBy, $sortType)->paginate(20);
    return view('page.log-history')->with(compact('logs', 'datas'));
  }
}
