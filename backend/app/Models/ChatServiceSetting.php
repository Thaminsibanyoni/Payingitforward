<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatServiceSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider', 
        'api_key',
        'api_secret',
        'project_id',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
