<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
    ];

    public function __construct(array $attributes = [])
    {
        $this->slug = md5(uniqid());
        parent::__construct($attributes);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
