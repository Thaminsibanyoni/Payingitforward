<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KindnessActRecipient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kindness_act_id',
        'name',
        'email',
        'relationship',
        'has_verified',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'has_verified' => 'boolean',
    ];

    /**
     * Get the kindness act that owns the recipient.
     */
    public function kindnessAct(): BelongsTo
    {
        return $this->belongsTo(KindnessAct::class);
    }
}
