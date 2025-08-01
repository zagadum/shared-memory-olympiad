<?php

namespace MemoryOlympiad\Models\Olympiad;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use MemoryOlympiad\Models\Olympiad\MOlympiadParams;
use MemoryOlympiad\Models\Olympiad\MParticipant;
use MemoryOlympiad\Models\Olympiad\MOlympiadTask;


class MOlympiadSubscribe extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_subscribe';

    protected $fillable = [
        'practicant_id',
        'olympiad_id',
        'language',
        'subscribe_date',
        'is_pay',
        'age_tab',
        'stages_level',
        'stages_num',
        'is_finish'
    ];


    public function Participant(){
        return $this->hasOne(MParticipant::class, 'id', 'practicant_id');
    }

    public function Olympiad(){
        return $this->hasOne(MOlympiad::class, 'id', 'olympiad_id');
    }

    public function IsFinish($subscribe_id=0,$practicant_id=0){
        if (empty($subscribe_id) || empty($practicant_id)) {
            return 0;
        }
        $subscribe = MOlympiadSubscribe::where('id',$subscribe_id)->where('practicant_id',$practicant_id)->first();
        if (!$subscribe) {
            return 0;
        }

        $params = MOlympiadParams::where([
            'olympiad_id' => $subscribe->olympiad_id,
            'age_tab' => $subscribe->age_tab,
            'stages_level' => $subscribe->stages_level,
            'stages_num' => $subscribe->stages_num,
        ])->get();

        $allTaskIds = $params->pluck('id');
        if ($allTaskIds->isEmpty()) {
            return 0; // нет параметров — нет задач
        }
        // Список выполненных задач
        $doneTaskIds  = MOlympiadTask::whereIn('params_id', $allTaskIds)
            ->where('is_self', 0)
            ->where('practicant_id', $practicant_id)
            ->where('subscribe_id', $subscribe_id)
            ->where('is_done', 1)
            ->pluck('id');

        if (empty($doneTaskIds)){
            return 0; // нет выполненных задач
        }
        $notDone = $allTaskIds->diff($doneTaskIds);

        if ($notDone->isEmpty()) {
            MOlympiadSubscribe::where('id', $subscribe_id)->where('practicant_id',$practicant_id)->update(['is_finish' => 1]);
            return 1; // все задачи выполнены
        }
    }
}
