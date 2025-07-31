<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadDescription extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_descriptions';

    protected $fillable = [
        'olympiad_id', 'title','cover','language', 'short_description'
    ];

    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }
    public function MOlympiadDescription()
    {
        return $this->hasMany(MOlympiadDescription::class, 'olympiad_id', 'id');
    }

}
