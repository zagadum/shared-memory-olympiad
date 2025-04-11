<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Model;

class MCountry extends Model
{
    protected $table = 'country';

    protected $fillable = [
        'name',
        'enabled',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];


}
