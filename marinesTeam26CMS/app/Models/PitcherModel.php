<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PitcherModel extends Model
{
    use HasFactory;
    protected $table = 'pitchers';
    public $timestamps = true;
    protected $fillable = [
        'teamCode',
        'playerCode',
        'playerName',
        'G',
        'CG',
        'SHO',
        'noWalks',
        'W',
        'L',
        'D',
        'SV',
        'HLD',
        'HLDP',
        'WPCT',
        'BF',
        'AB',
        'IP',
        'IP3',
        'H',
        'HR',
        'SH',
        'SF',
        'BB',
        'IBB',
        'HP',
        'SO',
        'WP',
        'BK',
        'R',
        'ER',
        'ERA',
        'IF',
        'updated_at'
    ];
}
