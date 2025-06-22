<?php

namespace MemoryOlympiad\Models\Olympiad;


use MemoryOlympiad\Models\Olympiad\MCity;
use MemoryOlympiad\Models\Olympiad\MCountry;
use MemoryOlympiad\Models\Olympiad\MRegion;
use MemoryOlympiad\Models\Olympiad\MPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiad extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiads';

    protected $fillable = [
        'country_id',
        'region_id',
        'city_id',
        'locality',
        'promotion', // enum {ads,olympiad}
        'is_international',
        'announcement_start_date',
        'announcement_end_date',
        'activation_date',
        'start_date',
        'end_date',
        'status',
        'local_price',
        'local_currency', //default UAH
        'international_price',
        'international_currency',//default EUR
        'created_by'
    ];

    protected $casts = [

        'announcement_start_date' => 'date:Y-m-d',
        'announcement_end_date' => 'date:Y-m-d',
        'activation_date' => 'date:Y-m-d',
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    public function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d');
    }


    public function City() {
        return $this->hasOne(MCity::class, 'id', 'city_id');

    }
    public function Region(){
        return $this->hasOne(MRegion::class, 'id', 'region_id');

    }
    public function Country() {
        return $this->hasOne(MCountry::class, 'id', 'country_id');

    }
    public function paymentsByParticipant($participant_id)
    {
        return $this->hasMany(MPayment::class, 'olympiad_id', 'id')
            ->where('participant_id', $participant_id);
    }
    /**
     * Check if the Olympiad is active based on the current date.
     *
     * @param string $startDate
     * @param string $endDate
     * @return bool
     */
    public function isOlympiadActive($OlympiadObj=[]) {

        $now = date('Y-m-d');

        if (empty($OlympiadObj)){
            return 'inactive';
        }
        if ($OlympiadObj['status'] == 'draft') {
            return 'draft';
        }
        $id=$OlympiadObj['id'] ?? null;
        $OlympiadObj=(array)$OlympiadObj;
        $startDate=$OlympiadObj['start_date'] ?? null;
        $endDate=$OlympiadObj['end_date'] ?? null;
         if ($now >= $startDate && $now <= $endDate){
             $this->UpdateStatus($id, $OlympiadObj['status'],'active');
            return 'active';
         }
        $announcement_start_date = $OlympiadObj['announcement_start_date'] ?? null;
        $announcement_end_date = $OlympiadObj['announcement_end_date'] ?? null;
        if ($now >= $announcement_start_date && $now <= $announcement_end_date){
            $this->UpdateStatus($id, $OlympiadObj['status'],'announced');
            return 'announced';
        }
        return 'completed';
    }
        private function UpdateStatus($id,$oldStatus=null, $status='')
        {
            if ($oldStatus == $status) {
                return;
            }
            if (empty($id)) {
                return;
            }
            if (!in_array($status, ['draft', 'announced', 'active', 'completed'])) {
                return;
            }

            $olympiad = MOlympiad::find($id);
            $olympiad->status = $status;
            $olympiad->save();

        }

}
