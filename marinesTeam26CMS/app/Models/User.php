<?php
namespace App\Models;
use Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  public $timestamps = false;
  protected $fillable = [
    'sort_no',
    'user_id',
    'password',
    'user_name',
    'permission',
    'created_at',
    'create_user',
    'updated_at',
    'update_user',
    'deleted_at',
    'delete_user'
  ];
  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password'
  ];
  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  public function permissionname()
  {
    return $this->hasOne(Permission::class,'id', "permission");
  }
}
