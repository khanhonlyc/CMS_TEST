<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Banner extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = false;
  protected $table = 'banner';
  protected $primaryKey = 'id';
  protected $fillable = [
    'banner_type_code',
    'sort_no',
    'title',
    'image_url',
    'url',
    'target',
    'fan_type_code',
    'publish_start',
    'publish_end',
    'status',
    'created_at',
    'create_user',
    'updated_at',
    'update_user',
    'deleted_at',
    'delete_user'
  ];
  public function fantypenameen()
  {
    return $this->belongsToMany(FanTypeNameEn::class, 'banner_fan_type', 'banner_id', 'fan_type_name_en_id');
  }
}
