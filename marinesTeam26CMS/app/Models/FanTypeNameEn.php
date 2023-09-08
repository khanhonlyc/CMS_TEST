<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FanTypeNameEn extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = false;
  protected $table = 'fan_type_name_en';
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
  public function fantypecodes()
  {
    return $this->morphTo();
  }
}
