<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupLog extends Model
{
    use HasFactory;

    protected $fillable = ['backup_file_path'];
    
    protected $casts = [
        'created_at' => 'datetime'
    ];
}
