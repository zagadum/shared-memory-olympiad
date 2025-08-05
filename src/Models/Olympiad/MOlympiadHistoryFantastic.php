<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadHistoryFantastic extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';


    protected $fillable = [
        'name',
    ];
    public function setLangTable($lang)
    {
        $this->setTable('training_history_fantastic_' . $lang);
    }

}
