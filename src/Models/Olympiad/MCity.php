<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Model;

class MCity extends Model
{
    protected $table = 'city';

    protected $fillable = [
        'name',
        'country_id',
        'region_id'

    ];

    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */


}
