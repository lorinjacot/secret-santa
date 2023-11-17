<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * L'utilisateur à qui l'utilisateur actuel doit donner des cadeaux.
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    /**
     * L'utilisateur qui doit donner des cadeaux à l'utilisateur actuel.
     */
    public function partner(): HasOne
    {
        return $this->hasOne(User::class, 'target_id');
    }

    /**
     * La conversion où l'utilisateur actuel est le père Noël.
     */
    public function santaConversation(): HasOne
    {
        return $this->hasOne(Conversation::class, 'santa_id');
    }

    /**
     * La conversion où l'utilisateur actuel est est la cible.
     */
    public function targetConversation(): HasOne
    {
        return $this->hasOne(Conversation::class, 'target_id');
    }

    /**
     * Les messages envoyés par l'utilisateur actuel.
     */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
