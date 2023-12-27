<?php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'title',
        'content',
        'like',
        'view',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeTitle( $query, string $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeApplyFilter($query, $filter)
    {
        switch ($filter) {
            case 'Most_views':
                return $query->orderBy('view', 'desc');
            case 'Most_likes':
                return $query->orderBy('like', 'desc');
            default:
                // 'Latest' or no filter, order by created_at in descending order
                return $query->latest();
        }
    }
}
