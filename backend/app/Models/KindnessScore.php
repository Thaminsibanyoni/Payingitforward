<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KindnessScore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'current_score',
        'total_score',
        'consistency_score',
        'impact_score',
        'community_score',
        'verification_score',
        'diversity_score',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'current_score' => 'float',
        'total_score' => 'float',
        'consistency_score' => 'float',
        'impact_score' => 'float',
        'community_score' => 'float',
        'verification_score' => 'float',
        'diversity_score' => 'float',
    ];

    /**
     * Get the user that owns the score.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate the community average score.
     *
     * @return float
     */
    public static function getCommunityAverage(): float
    {
        return self::avg('current_score') ?? 0;
    }

    /**
     * Get improvement tips based on the user's scores.
     *
     * @return array
     */
    public function getImprovementTips(): array
    {
        $tips = [];
        
        if ($this->consistency_score < 4.0) {
            $tips[] = 'Perform acts of kindness regularly to improve your consistency score';
        }
        
        if ($this->verification_score < 4.0) {
            $tips[] = 'Tag recipients to increase your verification rate';
        }
        
        if ($this->diversity_score < 4.0) {
            $tips[] = 'Try different categories of kindness acts to improve your diversity score';
        }
        
        if ($this->community_score < 4.0) {
            $tips[] = 'Participate in community initiatives to boost your community score';
        }
        
        if ($this->impact_score < 4.0) {
            $tips[] = 'Focus on acts with higher impact to improve your impact score';
        }
        
        // Add some general tips if the user is doing well in all categories
        if (count($tips) === 0) {
            $tips[] = 'Keep up the great work! Try inspiring others by sharing your kindness stories';
            $tips[] = 'Consider mentoring others in their kindness journey';
            $tips[] = 'Look for opportunities to create lasting impact through recurring acts';
        }
        
        return $tips;
    }

    /**
     * Update scores based on a new kindness act.
     *
     * @param KindnessAct $kindnessAct
     * @return void
     */
    public function updateScores(KindnessAct $kindnessAct): void
    {
        // Update impact score based on expected impact
        if ($kindnessAct->expected_impact === 'large') {
            $this->impact_score = min(5.0, $this->impact_score + 0.2);
        } elseif ($kindnessAct->expected_impact === 'medium') {
            $this->impact_score = min(5.0, $this->impact_score + 0.1);
        }
        
        // Update verification score if the act is verified
        if ($kindnessAct->is_verified) {
            $this->verification_score = min(5.0, $this->verification_score + 0.2);
        }
        
        // Update diversity score if the user is trying different categories
        $userCategories = KindnessAct::where('user_id', $this->user_id)
            ->distinct()
            ->pluck('category')
            ->count();
        
        if ($userCategories >= 5) {
            $this->diversity_score = min(5.0, $this->diversity_score + 0.3);
        } elseif ($userCategories >= 3) {
            $this->diversity_score = min(5.0, $this->diversity_score + 0.2);
        }
        
        // Update consistency score based on frequency of acts
        $recentActs = KindnessAct::where('user_id', $this->user_id)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        if ($recentActs >= 10) {
            $this->consistency_score = min(5.0, $this->consistency_score + 0.3);
        } elseif ($recentActs >= 5) {
            $this->consistency_score = min(5.0, $this->consistency_score + 0.2);
        } elseif ($recentActs >= 3) {
            $this->consistency_score = min(5.0, $this->consistency_score + 0.1);
        }
        
        // Update community score based on collaborations and chain participation
        if ($kindnessAct->collaborators()->count() > 0 || $kindnessAct->is_part_of_chain) {
            $this->community_score = min(5.0, $this->community_score + 0.2);
        }
        
        // Calculate current score as average of all scores
        $this->current_score = ($this->consistency_score + $this->impact_score + 
            $this->community_score + $this->verification_score + $this->diversity_score) / 5;
        
        // Update total score (historical average)
        $this->total_score = ($this->total_score + $this->current_score) / 2;
        
        $this->save();
    }
}
