<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use App\Models\UserPersonalInformation;
use Illuminate\Notifications\Notifiable;
use App\Models\EmergencyContactInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'first_name',
        'last_name',
        'middle_name',
        'department',
        'position',
        'email',
        'password',
        'gender',
        'entry_level',
        'image',
        'role_as',
        'employee_status',
        'last_seen',
        'new_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class, 'user_id', 'id');
    }

    public function emergencytContactInformation()
    {
        return $this->hasOne(EmergencyContactInformation::class, 'user_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }
}
