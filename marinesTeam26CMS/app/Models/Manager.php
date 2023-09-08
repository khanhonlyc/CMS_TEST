<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Manager extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'manager';
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
}
