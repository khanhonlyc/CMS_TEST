<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatterModel extends Model
{
    use HasFactory;
    protected $table = 'batters';
    public $timestamps = true;
    protected $fillable = [
        'teamCode',
        'playerCode',
        'playerName',
        'G',
        'PA',
        'AB',
        'R',
        'H',
        '2B',
        '3B',
        'HR',
        'TB',
        'RBI',
        'SB',
        'CS',
        'SH',
        'SF',
        'BB',
        'IBB',
        'HP',
        'SO',
        'GDP',
        'LOB',
        'AVG',
        'SLG',
        'OBP',
        'IF',
        'updated_at'
    ];
}
