<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'giver_slug',
        'receiver_slug',
    ];

    public function __construct(array $attributes = [])
    {
        $this->giver_slug = md5(uniqid());
        $this->receiver_slug = md5(uniqid());
        parent::__construct($attributes);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
