<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LogActivityModel extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'browsing_log';
  protected $primaryKey = 'id';
  protected $fillable = [
    'cookie',
    'session_id',
    'access_ip',
    'server',
    'method',
    'user_agent',
    'referer',
    'request_url',
    'query_string',
    'marines_id',
    'regist_dt'
  ];
}
