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
        'status',
        'local_price',
        'local_currency', //default UAH
        'international_price',
        'international_currency',//default EUR
        'created_by'
    ];

    protected $casts = [

        'announcement_start_date' => 'date:Y-m-d',
        'announcement_end_date' => 'date:Y-m-d',
        'activation_date' => 'date:Y-m-d',
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    public function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d');
    }


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
