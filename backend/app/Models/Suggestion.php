<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Suggestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'difficulty',
        'impact',
        'category',
        'estimated_points',
        'is_featured',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Get the users who have saved this suggestion.
     */
    public function savedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_saved_suggestions')
            ->withTimestamps();
    }

    /**
     * Get the users who have completed this suggestion.
     */
    public function completedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_completed_suggestions')
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    /**
     * Calculate estimated points based on difficulty and impact.
     */
    public function calculateEstimatedPoints(): int
    {
        $difficultyPoints = [
            'Easy' => 10,
            'Medium' => 20,
            'Hard' => 30,
        ];
        
        $impactPoints = [
            'Small' => 5,
            'Medium' => 15,
            'High' => 25,
        ];
        
        return ($difficultyPoints[$this->difficulty] ?? 10) + ($impactPoints[$this->impact] ?? 5);
    }

    /**
     * Get random suggestions.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRandomSuggestions(int $limit = 5)
    {
        return self::inRandomOrder()->limit($limit)->get();
    }

    /**
     * Get featured suggestions.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getFeaturedSuggestions(int $limit = 5)
    {
        return self::where('is_featured', true)->limit($limit)->get();
    }

    /**
     * Filter suggestions by difficulty, impact, and category.
     *
     * @param array $difficulties
     * @param array $impacts
     * @param array $categories
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filter(array $difficulties = [], array $impacts = [], array $categories = [])
    {
        $query = self::query();
        
        if (!empty($difficulties)) {
            $query->whereIn('difficulty', $difficulties);
        }
        
        if (!empty($impacts)) {
            $query->whereIn('impact', $impacts);
        }
        
        if (!empty($categories)) {
            $query->whereIn('category', $categories);
        }
        
        return $query;
    }
}
