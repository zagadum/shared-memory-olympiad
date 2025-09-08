<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Model;

class MCountry extends Model
{
    protected $table = 'country';
    protected $connection = 'memory_olympiad';
    protected $fillable = [
        'name',
        'name_uk',
        'name_pl',
        'name_en',
        'img',
        'enabled',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];


}
