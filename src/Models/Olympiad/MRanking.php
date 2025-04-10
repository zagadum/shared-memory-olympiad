<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRanking extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_rankings';

    protected $fillable = [
        'olympiad_id', 'participant_id', 'place', 'score'
    ];
}
