<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class Snap extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'snap_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'snap_caption',
        'snap_privacy',
        'snap_image',
        'snapable_id',
        'snapable_type'
    ];

    public function reacts(): HasMany
    {
        return $this->hasMany(React::class, 'snap_id', 'snap_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'snap_id', 'snap_id');
    }

    public function saves(): HasMany
    {
        return $this->hasMany(SaveSnap::class, 'snap_id', 'snap_id');
    }

    public function snapable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeTrending(Builder $query): void
    {
        $query->with(['snapable', 'comments'])
            ->withCount('reacts')
            ->having('reacts_count', '>', 1000);
    }

    public function trendingCount(): string
    {
        return $this->scopeTrending->count();
    }

    public function totalReacts(): int
    {
        return $this->reacts->count();
    }

    public function totalComments(): int
    {
        return $this->comments->count();
    }

    public function hasUserReact(): bool
    {
        return $this->reacts->contains('user_id', Auth::user()->user_id);
    }

    public function isSave(): bool
    {
        return $this->saves->contains('user_id', Auth::user()->user_id);
    }

    public function isUserSnap(): bool
    {
        return $this->snapable->user_id === Auth::user()->user_id;
    }
}
