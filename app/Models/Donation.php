<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept',
        'value',
        'users_id',
        'programs_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id')->withDefault();
    }
    public function proram()
    {
        return $this->belongsTo(Program::class, 'programs_id', 'id')->withDefault();
    }
}
