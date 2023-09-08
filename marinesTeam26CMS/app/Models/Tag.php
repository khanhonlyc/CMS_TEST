<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tag extends Model
{
  use HasFactory, SoftDeletes;
  public $timestamps = false;
  protected $table = 'tag';
  protected $primaryKey = 'id';
  protected $fillable = [
    'tag_id',
    'tag_name',
    'created_at',
    'create_user',
    'updated_at',
    'update_user',
    'deleted_at',
    'delete_user'
  ];
  public function movies() {
    return $this->belongsToMany(Movie::class, 'tag_movie');
  }
}
