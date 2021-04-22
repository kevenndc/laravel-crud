<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'is_featured',
        'featured_image',
    ];
    // the author of the post

    /**
     * The post author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the total number of posts and the number of posts for each status (published, draft, trashed).
     *
     * @return array
     */
    public static function getCounts() {
        return collect([
            'posts' => self::all()->count(),
            'published' => self::where('published', 1)->count(),
            'drafts' => self::where('published', 0)->count(),
            'trashed' => self::onlyTrashed()->count(),
        ]);
    }
}
