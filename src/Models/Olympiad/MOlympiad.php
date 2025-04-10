<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiad extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiads';

    protected $fillable = [
        'type', 'country', 'city',
        'announcement_start_date', 'announcement_end_date',
        'activation_date', 'start_date', 'end_date',
        'language_tabs', 'status', 'created_by'
    ];

    protected $casts = [

        'announcement_start_date' => 'date',
        'announcement_end_date' => 'date',
        'activation_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
//    public function getDescibe(){
//        return $this->hasOne(MOlympiadDescription::class, 'olympiad_id', 'id');
//    }

}
