<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ViewedMessage extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'viewed_messages';
  protected $fillable = [
    'amcno',
    'messageid',
    'created_at'
  ];
}
