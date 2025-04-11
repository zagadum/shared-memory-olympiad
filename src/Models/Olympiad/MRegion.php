<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Model;

class MRegion extends Model
{
    protected $table = 'region';

    protected $fillable = [
        'name',
        'country_id',
        'enabled',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];




}
