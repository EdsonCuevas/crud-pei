<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'creator_id',
        'coordi_id',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('approved');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordi_id');
    }
}
