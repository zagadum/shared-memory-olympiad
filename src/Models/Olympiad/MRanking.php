<?php

namespace App\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRanking extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_rankings';

    protected $fillable = [
        'm_olympiad_id', 'm_participant_id', 'place', 'score'
    ];
}
