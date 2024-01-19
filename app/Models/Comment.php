<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'comment_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'snap_id',
        'user_id',
        'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function snap(): BelongsTo
    {
        return $this->belongsTo(Snap::class, 'snap_id', 'snap_id');
    }
}
