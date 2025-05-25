<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadParams extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_params';

    protected $fillable = [
        'olympiad_id',
        'stages_level',
        'age_tab',
        'stages_num',
        'is_basic',
        'is_intermediate',
        'is_pro',
        'training_type_id',
        'params_json'
    ];

    protected $dates = [
        'created_at',
        'updated_at',

    ];
    protected $casts = [
        'stages_level' => 'string',
        'age_tab' => 'string',
        'params_json' => 'array',
    ];

    // Связь с моделью MOlympiad
    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }
}