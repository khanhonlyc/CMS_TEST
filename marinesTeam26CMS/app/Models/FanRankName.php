<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FanRankName extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'fan_rank_name';
  protected $fillable = [
    'fantypecode',
    'fantypename',
    'fantypenameen',
    'created_at',
    'create_user',
    'updated_at',
    'update_user',
    'deleted_at',
    'delete_user'
  ];
}
