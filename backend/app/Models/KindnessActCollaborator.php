<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KindnessActCollaborator extends Model
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
    ];

    /**
     * Get the kindness act that owns the collaborator.
     */
    public function kindnessAct(): BelongsTo
    {
        return $this->belongsTo(KindnessAct::class);
    }
}
