<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = ['user_id', 'last_name', 'first_name', 'middle_name', 'time_in','time_out','status', 'day', 'date'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
