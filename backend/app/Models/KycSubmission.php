<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'front_image_path',
        'back_image_path',
        'selfie_image_path',
        'status',
        'reviewed_by'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
}
