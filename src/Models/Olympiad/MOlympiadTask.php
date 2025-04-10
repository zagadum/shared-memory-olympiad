<?php
namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadTask extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_tasks';

    protected $fillable = [
        'm_olympiad_id', 'task_description', 'task_type'
    ];

    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }
}
