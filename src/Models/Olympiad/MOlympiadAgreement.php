<?php

namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOlympiadAgreement extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_olympiad_agreement';

    protected $fillable = [
        'olympiad_id', 'language',  'agreement'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function olympiad()
    {
        return $this->belongsTo(MOlympiad::class, 'olympiad_id');
    }
}
