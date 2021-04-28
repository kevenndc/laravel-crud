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
     * Handles the insertion of the slug attribute.
     * @param string $value The slug of the post.
     */
    public function setSlugAttribute(string $value)
    {
        if (static::whereSlug($value)->exists()) {
            $value = $this->incrementSlug($value);
        }
        $this->attributes['slug'] = $value;
    }

    /**
     * Increment a number to the final of the slug until it is unique.
     *
     * @param $slug
     * @return string
     */
    private function incrementSlug($slug)
    {
        $relatedSlugs = $this->getRelatedSlugs($slug);
        $i = 2;
        do {
            $newSlug = $slug . '-' . $i++;
        } while (in_array($newSlug, $relatedSlugs));

        return $newSlug;
    }


    /**
     * Retrieves all the slugs like the the on passed as argument.
     *
     * @param $slug
     * @return array
     */
    public function getRelatedSlugs($slug)
    {
        return static::where('slug', 'LIKE', "{$slug}%")
                        ->where('id', '<>', $this->id)
                        ->pluck('slug')
                        ->toArray();
    }

    /**
     * Get the total number of posts and the number of posts for each status (published, draft, trashed).
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getCounts() {
        return collect([
            'posts' => static::all()->count(),
            'published' => static::where('published', 1)->count(),
            'drafts' => static::where('published', 0)->count(),
            'trashed' => static::onlyTrashed()->count(),
        ]);
    }
}
