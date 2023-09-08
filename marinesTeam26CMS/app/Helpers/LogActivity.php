<?php
namespace App\Helpers;
use Request;
use App\Models\LogActivityModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
class LogActivity
{
  public static function addToLog($userid, $username)
  {
    $url_components = parse_url(Request::fullUrl());
    $log = [];
    $now = Carbon::now()->toDateTimeString();
    $log['cookie'] = '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd1';
    $log['session_id'] = session('user_id');
    $log['access_ip'] = Request::ip();
    $log['server'] = Str::uuid();
    $log['method'] = Request::method();
    $log['user_agent'] = Request::header('user-agent');
    $log['referer'] = $username;
    $log['request_url'] = Request::fullUrl();
    $log['query_string'] = json_encode($url_components, JSON_FORCE_OBJECT);
    $log['marines_id'] = $userid;
    $log['regist_dt'] = $now;
    LogActivityModel::create($log);
  }
  public static function logActivityLists()
  {
    return LogActivityModel::latest()->get();
  }
}
