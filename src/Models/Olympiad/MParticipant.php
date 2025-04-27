<?php
namespace MemoryOlympiad\Models\Olympiad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MParticipant extends Model
{
    use HasFactory;

    protected $connection = 'memory_olympiad';
    protected $table = 'm_participants';

    protected $fillable = [
        'name', 'surname', 'lastname', 'patronymic',
        'email', 'email_verified_at', 'phone', 'phone_country',
        'country_id', 'region_id', 'city_id', 'locality',
        'school', 'age_id', 'blocked', 'deleted', 'last_login_at',
        'password', 'remember_token', 'api_token', 'student_id', 'dob'
    ];

    protected $hidden = ['password', 'remember_token', 'api_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'blocked' => 'boolean',
        'deleted' => 'boolean',
    ];

    // Автоматическое хеширование пароля
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Генерация API-токена
    public static function boot()
    {
        parent::boot();

        static::creating(function ($participant) {
            $participant->api_token = Str::random(80);
        });
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

    function getAgeFromDob($dob)
    {
        $dob = new DateTime($dob);
        $now = new DateTime();
        $age = $now->diff($dob)->y;
    }

        // Связи
    public function olympiads()
    {
        return $this->hasMany(MOlympiad::class, 'created_by');
    }
}
