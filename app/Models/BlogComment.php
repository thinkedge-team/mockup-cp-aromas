<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'parent_id',
        'author_name',
        'author_email',
        'content',
        'is_approved',
        'is_verified',
        'is_official',
        'is_hidden',
        'likes',
    ];

    protected $casts = [
        'post_id' => 'integer',
        'parent_id' => 'integer',
        'is_approved' => 'boolean',
        'is_verified' => 'boolean',
        'is_official' => 'boolean',
        'is_hidden' => 'boolean',
        'likes' => 'integer',
    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }

    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeParentComments($query)
    {
        return $query->whereNull('parent_id');
    }
}
