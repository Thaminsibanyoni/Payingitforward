<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KindnessPoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'kindness_act_id',
        'points',
        'description',
        'category',
    ];

    /**
     * Get the user that owns the points.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kindness act that earned the points.
     */
    public function kindnessAct(): BelongsTo
    {
        return $this->belongsTo(KindnessAct::class);
    }

    /**
     * Get points earned by a user in a specific month.
     *
     * @param int $userId
     * @param string $month Format: 'Y-m'
     * @return int
     */
    public static function getPointsForMonth(int $userId, string $month): int
    {
        return self::where('user_id', $userId)
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$month])
            ->sum('points');
    }

    /**
     * Get monthly points history for a user.
     *
     * @param int $userId
     * @param int $months Number of months to retrieve
     * @return array
     */
    public static function getMonthlyHistory(int $userId, int $months = 6): array
    {
        $history = [];
        $currentMonth = now();

        for ($i = 0; $i < $months; $i++) {
            $month = $currentMonth->copy()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $monthName = $month->format('M');
            
            $points = self::getPointsForMonth($userId, $monthKey);
            
            $history[] = [
                'month' => $monthName,
                'points' => $points,
            ];
        }

        return array_reverse($history);
    }

    /**
     * Get recent activities for a user.
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRecentActivities(int $userId, int $limit = 5)
    {
        return self::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
