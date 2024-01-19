<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class Page extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'page_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'page_name',
        'page_profile',
        'page_cover',
    ];

    public function snaps(): MorphMany
    {
        return $this->morphMany(Snap::class, 'snapable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function pageFollowers(): HasMany
    {
        return $this->hasMany(PageFollower::class, 'page_id', 'page_id');
    }

    public function scopePopular(Builder $query): void
    {
        $query->withCount('pageFollowers')
            ->having('page_followers_count', '>', 1000);
    }

    public function isPageCreator(): bool
    {
        return $this->user->user_id === Auth::user()->user_id;
    }

    public function isPageFollowed(): bool
    {
        return $this->pageFollowers->contains('user_id', Auth::user()->user_id);
    }

    public function pageFollowerCount(): string
    {
        return Number::abbreviate($this->pageFollowers->count());
    }
}
