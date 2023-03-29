<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContactInformation extends Model
{
    use HasFactory;

    protected $table = 'emergency_contact_information';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'address',
        'phone_no',
        'relationship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
