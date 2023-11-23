<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'santa_id',
        'target_id',
    ];

    /**
     * L'utilisateur qui est le père Noël dans cette conversation.
     */
    public function santa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'santa_id');
    }

    /**
     * L'utilisateur qui reçoit des cadeaux dans cette conversation.
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    /**
     * Les messages de cette conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Les images de cette conversation.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
