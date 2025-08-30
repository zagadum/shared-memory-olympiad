<?php

namespace MemoryOlympiad\Models\Olympiad;


use MemoryOlympiad\Models\Olympiad\MCity;
use MemoryOlympiad\Models\Olympiad\MCountry;
use MemoryOlympiad\Models\Olympiad\MRegion;
use MemoryOlympiad\Models\Olympiad\MPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
        'created_by',
        'domain'
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
    public function MOlympiadDescriptions()
    {
        return $this->hasMany(MOlympiadDescription::class, 'olympiad_id', 'id');
    }

    public function getDescriptionsAttribute(): Collection
    {
        return $this->MOlympiadDescriptions->mapWithKeys(function ($item) {
            return [
                $item->language => [
                    'title' => $item->title,
                    'cover' => $item->cover,
                    'short_description' => $item->short_description,
                ],
            ];
        });
    }

    public function MOlympiadDescriptionFull()
    {
        return $this->hasMany(MOlympiadDescriptionFull::class, 'olympiad_id', 'id');
    }

    public function getDescriptionsFullAttribute(): Collection
    {
        return $this->olympiadDescriptionsFull->mapWithKeys(function ($item) {
            return [
                $item->language => [
                    'full_description' => $item->full_description,
                ],
            ];
        });
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

        if (is_object($OlympiadObj)){
            $OlympiadObj=(array)$OlympiadObj;
        }
        $nowBegin = strtotime(date('Y-m-d 00:00:00'));
        $nowEnd = strtotime(date('Y-m-d 23:59:59'));
        $now  = strtotime("now");


        $OlympiadObj['status']=$OlympiadObj['status']??null;

        if (empty($OlympiadObj)){
            return 'inactive';
        }
        if (empty($OlympiadObj['status'])){
            return 'inactive';
        }
        if (isset($OlympiadObj['status']) && $OlympiadObj['status'] == 'draft') {
            return 'draft';
        }
        $id=$OlympiadObj['id'] ?? null;
        $OlympiadObj=(array)$OlympiadObj;
        if (!empty($OlympiadObj['start_date'])){
            $startDate=strtotime($OlympiadObj['start_date'].' 00:00:00');
        }
        if (!empty($OlympiadObj['end_date'])){
            $endDate=strtotime($OlympiadObj['end_date'].' 23:59:59');
        }

        $statusSet= 'draft';
        if ( isset($endDate)  && $now > $endDate){
            print '<br>'.$OlympiadObj['id'].' end '.date('d.m.Y H:i:s',$endDate).' = '.$OlympiadObj['end_date'].' now '.date('d.m.Y H:i:s',$now).'<br>';
            $statusSet= 'completed';
        }elseif (isset($startDate) && isset($endDate)   && $now >= $startDate && $now <= $endDate){
             $statusSet='active';
         }else{
             if (!empty($OlympiadObj['announcement_start_date'])){
                 $announcement_start_date=strtotime($OlympiadObj['announcement_start_date'].' 00:00:00');
             }
             if (!empty($OlympiadObj['announcement_end_date'])){
                 $announcement_end_date=strtotime($OlympiadObj['announcement_end_date'].' 23:59:59');
             }
             if (isset($announcement_start_date) && isset($announcement_end_date) && $now >= $announcement_start_date && $now <= $announcement_end_date){
                 $statusSet= 'announced';
             }
         }

        if (isset($OlympiadObj['status']) &&  $statusSet !='draft' ) {
            $this->UpdateStatus($id, $OlympiadObj['status'],$statusSet);
        }
        return $statusSet;
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
