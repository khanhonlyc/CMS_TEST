<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EditPermission extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'edit_permission';
  protected $fillable = [
    'permission_id',
    'permission_name',
    'created_at',
    'create_user',
    'deleted_at',
    'delete_user'
  ];
}
