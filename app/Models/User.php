<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'phone_number',
        'address',
        'facebook_id',
        'google_id',
        'password',
        'is_active',
        'has_profile',
        'has_cover_photo',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
        'facebook_id',
        'google_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower(str_replace(' ', '', $value)),
        );
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class, 'user_id', 'user_id');
    }

    public function coverPhoto(): HasOne
    {
        return $this->hasOne(CoverPhoto::class, 'user_id', 'user_id');
    }

    public function snaps(): MorphMany
    {
        return $this->morphMany(Snap::class, 'snapable');
    }

    public function reacts(): HasMany
    {
        return $this->hasMany(React::class, 'user_id', 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    public function saves(): HasMany
    {
        return $this->hasMany(SaveSnap::class, 'user_id', 'user_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class, 'followed_user_id', 'user_id');
    }

    public function following(): HasMany 
    {
        return $this->hasMany(Follower::class, 'request_user_id', 'user_id');
    }
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class, 'user_id', 'user_id');
    }

    public function pageFollower(): HasOne
    {
        return $this->hasOne(PageFollower::class, 'user_id', 'user_id');
    }

    // public function scopePopular(Builder $query): void
    // {
    //     $query->with()
    // }

    public function isFollowed(): bool
    {
        return $this->followers->contains('request_user_id', Auth::user()->user_id);
    }

    public function isFollowing(): bool
    {
        return $this->following->contains('followed_user_id', Auth::user()->user_id);
    }

    public function isFriend(): bool
    {
        return $this->friends->contains('user_id', Auth::user()->user_id);
    }

    public function totalFollowers(): int
    {
        return $this->followers->count();
    }
}
