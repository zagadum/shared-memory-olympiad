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
        'olympiad_id',
        'participant_id',
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

    public function task()
    {
        return $this->belongsTo(MOlympiadTask::class, 'task_id');
    }

    static public function SaveResultExternal($external=[],$resultInfo=[]){
        if (empty($external) || empty($resultInfo)) {
            return false;
        }

        $participant_id = $external['participant_id'] ?? null;
        $TotalTimeShow=$resultInfo['TotalTimeShow']??0;
        $TotalTimeEnter=$resultInfo['TotalTimeEnter']??0;
        $totalBall=$isFinish['bals']['total']??0;
        $Good=$isFinish['bals']['good']??0;
        $Bad=$isFinish['bals']['bad']??0;
        $table_link='';


        $TaskResult = [
            'olympiad_id' => $external['add_vars']['olympiad_id'] ?? null,
            'participant_id' => $participant_id,
            'task_id' =>  $external['add_vars']['task_id'] ?? null,
            'table_link' => $table_link,
            'result_date' => now(),
            'time_memory' => $TotalTimeShow,
            'time_answer' => $TotalTimeEnter,
            'total' => $totalBall,
            'good' => $Good,
            'bad' => $Bad

        ];
        $result = MOlympiadResult::create($TaskResult);
        $idResult = $result->id;
        $FullResult=(object)[];
        $FullResult['PageList']=session()->get('PageList',[]);
        $FullResult['TrainingTask']=session()->get('TrainingTask',[]);
        $FullResult['TrainingParams']=session()->get('TrainingParams',[]);
        $FullResult['resultSave']=session()->get('resultSave',[]);
        $FullResult['analize']=$isFinish['analize']??[];
        MOlympiadResult::where('id',$idResult)->update(['full_info'=>json_decode(json_encode($FullResult))]);

    }
}
