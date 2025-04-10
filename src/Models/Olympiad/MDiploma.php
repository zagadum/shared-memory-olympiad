<?php


namespace MemoryOlympiad\Models\Olympiad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDiploma extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_diplomas';

    protected $fillable = [
        'olympiad_id', 'template_name', 'category', 'diploma_text'
    ];
}
