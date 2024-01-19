<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class React extends Model
{
    use HasUuids, HasFactory;

    protected $primaryKey = 'react_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'snap_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
