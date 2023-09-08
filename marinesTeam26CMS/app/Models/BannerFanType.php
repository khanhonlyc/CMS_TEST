<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BannerFanType extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'banner_fan_type';
  protected $fillable = [
    'banner_id',
    'fan_type_name_en_id',
  ];
}
