<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Movie extends Model
{
  use HasFactory , SoftDeletes;
  public $timestamps = false;
  protected $table = 'movie';
  protected $fillable = [
    'movie_type_code',
    'sort_no',
    'title',
    'thumbnail_url',
    'sauce',
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
  public function tags() {
    return $this->belongsToMany(Tag::class, 'tag_movie');
  }
}
