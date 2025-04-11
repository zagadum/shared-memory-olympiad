<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadDescriptionFull extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_descriptions_full';

    protected $fillable = [
        'olympiad_id', 'language',  'full_description'
    ];

    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }
}
