<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogAuthor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'avatar',
        'initials',
        'role',
        'bio',
        'instagram',
        'linkedin',
        'twitter',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Str::slug($model->name);
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
