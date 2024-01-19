<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Follower extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'follower_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'request_user_id',
        'followed_user_id'
    ];

    public function userFollower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'request_user_id', 'user_id');
    }

    public function userFollowing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'followed_user_id', 'user_id');
    }
}
