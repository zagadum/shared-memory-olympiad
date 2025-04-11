<?php

namespace MemoryOlympiad\Models\Olympiad;


use MemoryOlympiad\Models\Olympiad\MCity;
use MemoryOlympiad\Models\Olympiad\MCountry;
use MemoryOlympiad\Models\Olympiad\MRegion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiad extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiads';

    protected $fillable = [
        'country_id',
        'region_id',
        'city_id',
        'locality',
        'promotion', // enum {ads,olympiad}
        'is_international',
        'announcement_start_date',
        'announcement_end_date',
        'activation_date',
        'start_date',
        'end_date',
        'status', 'created_by'
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

    public function City() {
        return $this->hasOne(MCity::class, 'id', 'city_id');

    }
    public function Region(){
        return $this->hasOne(MRegion::class, 'id', 'region_id');

    }
    public function Country() {
        return $this->hasOne(MCountry::class, 'id', 'country_id');

    }
}
