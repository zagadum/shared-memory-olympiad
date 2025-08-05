<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadWordsTask extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';


    protected $fillable = [
        'id',
        'name',
        'part_word',
        'lang',
        'is_practice',
        'is_profi'
    ];


    protected $dates = [

    ];
    public function setLangTable($lang)
    {
        $this->setTable('training_words_task_' . $lang);
    }

}