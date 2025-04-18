<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadResult extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_results';

    protected $fillable = [
        'olympiad_id', 'participant_id', 'task_id',
        'result_date', 'score', 'total_tasks', 'correct_answers',
        'wrong_answers', 'accuracy_percentage'
    ];

    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }

    public function participant()
    {
        return $this->belongsTo(MParticipant::class, 'participant_id');
    }

    public function task()
    {
        return $this->belongsTo(MOlympiadTask::class, 'task_id');
    }
}
