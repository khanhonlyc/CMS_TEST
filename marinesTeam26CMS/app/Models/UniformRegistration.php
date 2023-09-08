<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UniformRegistration extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'uniform_registration';
  protected $fillable = [
    'amcno',
    'name',
    'uniformnum',
    'created_at',
    'updated_at'
  ];
}
