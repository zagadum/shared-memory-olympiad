<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadHistoryTasl extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';


    protected $fillable = [
        'year',
        'name',
        'category_id'
    ];
    public function setLangTable($lang)
    {
        $this->setTable('training_history_task_' . $lang);
    }

}