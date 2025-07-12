<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Model;

class MCountry extends Model
{
    protected $table = 'country';
    protected $connection = 'memory_olympiad';
    protected $fillable = [
        'name',
        'enabled',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];


}
