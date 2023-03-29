<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;


    protected $table = 'personal_information';
    protected $fillable = [
        'user_id',
        'phone_no',
        'address',
        'dob',
        'birth_place',
        'age',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
