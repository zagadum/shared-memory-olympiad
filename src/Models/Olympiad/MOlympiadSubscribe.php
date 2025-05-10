<?php

namespace MemoryOlympiad\Models\Olympiad;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadSubscribe extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_payments';

    protected $fillable = [
        'practicant_id', 'olympiad_id', 'is_pay'
    ];


    public function Participant(){
        return $this->hasOne(MParticipant::class, 'id', 'practicant_id');
    }

    public function Olympiad(){
        return $this->hasOne(MOlympiad::class, 'id', 'olympiad_id');
    }


}
