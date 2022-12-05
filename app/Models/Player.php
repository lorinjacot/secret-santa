<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'picked_by',
    ];

    public function pickedBy()
    {
        return $this->belongsTo(Player::class, 'picked_by');
    }

    public function picked()
    {
        return $this->hasOne(Player::class, 'picked_by');
    }
}