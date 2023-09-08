<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TagMovie extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'tag_movie';
  protected $fillable = [
    'tag_id',
    'movie_id',
  ];
}
