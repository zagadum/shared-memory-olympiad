<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Model;

class MCity extends Model
{
    protected $table = 'city';

    protected $fillable = [
        'name',
        'country_id',
        'region_id',
        'enabled',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/cities/'.$this->getKey());
    }
}
