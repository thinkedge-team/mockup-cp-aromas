<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchHeroSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'stats' => 'array',
        'is_active' => 'boolean',
    ];
}
