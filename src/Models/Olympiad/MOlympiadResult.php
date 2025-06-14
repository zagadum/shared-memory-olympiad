<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MemoryOlympiad\Models\Olympiad\MOlympiadTasks;


class MOlympiadResult extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_results';

    protected $fillable = [
        'olympiad_id',
        'practicant_id',
        'subscribe_id',
        'is_self',
        'task_id',
        'table_link',
        'result_date',
        'time_memory',
        'time_answer',
        'total',
        'total_tasks',
        'good',
        'bad',
        'full_info'

    ];

    protected $casts = [
        'full_info' => 'array',
    ];

    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }

    public function participant()
    {
        return $this->belongsTo(MParticipant::class, 'participant_id');
    }

    static public function SaveResultExternal($external=[],$isFinish=[]){
        if (empty($external)) {
            return false;
        }


        if (empty($external['practicant_id'])) {
            return false;
        }

        $practicant_id = $external['practicant_id'] ?? 0;
        $TotalTimeShow=$isFinish['TotalTimeShow']??0;
        $TotalTimeEnter=$isFinish['TotalTimeEnter']??0;

        $totalBall=$isFinish['bals']['total']??0;
        $Good=$isFinish['bals']['good']??0;
        $Bad=$isFinish['bals']['bad']??0;
        $table_link= $external['add_vars']['table_link']?? null;

        if ($external['add_vars']['task_id']>0) {
         $OlympyadTaskInfo= MOlympiadTasks::where('task_id', $external['add_vars']['task_id'])->where('practicant_id', $practicant_id)->first();
        }
        $TaskResult = [
            'olympiad_id' => $external['add_vars']['olympiad_id'] ?? null,
            'practicant_id' => $practicant_id,
            'task_id' =>  $external['add_vars']['task_id'] ?? null,
            'subscribe_id' =>  $external['add_vars']['subscribe_id'] ?? $OlympyadTaskInfo['subscribe_id'] ?? null,
            'is_self' =>  $OlympyadTaskInfo['is_self'] ?? 0,
            'table_link' => $table_link,
            'result_date' => now(),
            'time_memory' => $TotalTimeShow,
            'time_answer' => $TotalTimeEnter,
            'total' => $totalBall,
            'good' => $Good,
            'bad' => $Bad

        ];
        $result = MOlympiadResult::create($TaskResult);
        $idResult = $result->id??0;
        $FullResult= [];
        $FullResult['PageList']=session()->get('PageList',[]);
        $FullResult['TrainingTask']=session()->get('TrainingTask',[]);
        $FullResult['TrainingParams']=session()->get('TrainingParams',[]);
        $FullResult['resultSave']=session()->get('resultSave',[]);
        $FullResult['isFinish']=$isFinish['isFinish']??[];

        if (!empty($idResult)){
            MOlympiadResult::where('id',$idResult)->update(['full_info'=>$FullResult]);
        }


        if ($external['add_vars']['task_id']>0){
            MOlympiadTasks::where('task_id', $external['add_vars']['task_id'])
                ->where('practicant_id', $practicant_id)
                ->update(['is_done' => 1]);
        }
        return $idResult;
    }
}
