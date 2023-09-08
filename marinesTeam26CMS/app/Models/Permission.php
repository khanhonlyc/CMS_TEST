<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'permission';
  protected $fillable = [
    'permission_id',
    'permission_name',
    'created_at',
    'create_user',
    'deleted_at',
    'delete_user'
  ];
  public function user()
  {
    return $this->hasOne(User::class,"id");
  }
}
