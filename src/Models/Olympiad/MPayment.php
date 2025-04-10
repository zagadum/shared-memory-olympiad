<?php

namespace App\Models\Olympiad;

use App\Models\Franchisee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPayment extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_payments';

    protected $fillable = [
        'participant_id', 'olympiad_id', 'amount', 'currency', 'status','payment_date'
    ];


    public function Participant(){
        return $this->hasOne(MParticipant::class, 'id', 'participant_id');
    }

    public function Olympiad(){
        return $this->hasOne(MOlympiad::class, 'id', 'olympiad_id');
    }

}
