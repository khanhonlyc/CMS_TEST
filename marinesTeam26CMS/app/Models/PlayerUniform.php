<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PlayerUniform extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'player_uniform';
  protected $fillable = [
    'playerCode',
    'playerUniformNo',
    'player',
    'playerName',
    'created_at',
    'updated_at'
  ];
}
