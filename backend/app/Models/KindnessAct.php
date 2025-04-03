<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KindnessAct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'location',
        'date',
        'recipient_type',
        'is_public',
        'allow_verification',
        'image_path',
        'tags',
        'impact_description',
        'expected_impact',
        'resources_used',
        'inspiration',
        'follow_up_plans',
        'is_part_of_chain',
        'previous_act_id',
        'estimated_completion_time',
        'is_recurring',
        'recurring_frequency',
        'is_verified',
        'likes_count',
        'comments_count',
        'points_earned',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'is_public' => 'boolean',
        'allow_verification' => 'boolean',
        'tags' => 'array',
        'resources_used' => 'array',
        'is_part_of_chain' => 'boolean',
        'is_recurring' => 'boolean',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the user that owns the kindness act.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the previous act in the kindness chain.
     */
    public function previousAct(): BelongsTo
    {
        return $this->belongsTo(KindnessAct::class, 'previous_act_id');
    }

    /**
     * Get the next acts in the kindness chain.
     */
    public function nextActs(): HasMany
    {
        return $this->hasMany(KindnessAct::class, 'previous_act_id');
    }

    /**
     * Get the recipients of the kindness act.
     */
    public function recipients(): HasMany
    {
        return $this->hasMany(KindnessActRecipient::class);
    }

    /**
     * Get the collaborators of the kindness act.
     */
    public function collaborators(): HasMany
    {
        return $this->hasMany(KindnessActCollaborator::class);
    }

    /**
     * Get the points earned for this kindness act.
     */
    public function points(): HasMany
    {
        return $this->hasMany(KindnessPoint::class);
    }

    /**
     * Calculate points based on the kindness act attributes.
     */
    public function calculatePoints(): int
    {
        $points = 10; // Base points
        
        // Add points based on category
        if (in_array($this->category, ['volunteering', 'community_service', 'donation'])) {
            $points += 15;
        } elseif (in_array($this->category, ['environmental', 'animal_welfare', 'education'])) {
            $points += 10;
        } else {
            $points += 5;
        }
        
        // Add points based on expected impact
        if ($this->expected_impact === 'large') {
            $points += 15;
        } elseif ($this->expected_impact === 'medium') {
            $points += 10;
        } elseif ($this->expected_impact === 'small') {
            $points += 5;
        }
        
        // Add points for detailed description
        if (strlen($this->description) > 100) {
            $points += 5;
        }
        
        // Add points for adding an image
        if ($this->image_path) {
            $points += 5;
        }
        
        // Add points for tagging recipients
        $points += $this->recipients()->count() * 3;
        
        // Add points for adding collaborators
        $points += $this->collaborators()->count() * 2;
        
        // Add points for being part of a kindness chain
        if ($this->is_part_of_chain) {
            $points += 10;
        }
        
        // Add points for recurring acts
        if ($this->is_recurring) {
            $points += 8;
        }
        
        return $points;
    }
}
