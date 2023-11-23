<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable=[
        'conversation_id',
        'sender_id',
        'path',
    ];

    /**
     * L'url de l'image.
     */
    public function url(): Attribute
    {
        return new Attribute(
            get: fn () => Storage::disk('public')->url($this->path),
        );
    }

    /**
     * L'utilisateur qui a envoyé cette image.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * La conversation à laquelle appartient cette image.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}
