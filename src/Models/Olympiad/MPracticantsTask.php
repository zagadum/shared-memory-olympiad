<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPracticantsTask extends Model
{
    use HasFactory;
    protected $connection = 'memory_olympiad';
    protected $table = 'm_practicants_task';
    protected $primaryKey = 'task_id';

    protected $fillable = [
        'practicant_id',
        'olympiad_id',
        'params_id',
        'date_start',
        'add_params',
        'is_self',
        'is_done',
    ];

    protected $casts = [
        'add_params' => 'array',
        'is_self' => 'boolean',
        'is_done' => 'boolean',
    ];

    public $timestamps = false;


}