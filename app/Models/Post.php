<?php

namespace App\Models;

use App\Services\LocalUploadStorageService;
use App\Services\UploadStorageService;
use Carbon\Carbon;
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
        'published',
    ];

    protected $dates = [
        'created_at',
        'published_at',
    ];

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
     * Returns a formatted date for the published_at attribute.
     *
     * @param $value
     * @return string
     */
    public function getPublishedAtAttribute($value)
    {
        if (isset($value)) {
            $value = Carbon::parse($value)->format('d/m/Y \\a\\t H:i');
        }
        return $value;
    }

    /**
     * Returns a formatted date for the created_at attribute.
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        if (isset($value)) {
            $value = Carbon::parse($value)->format('d/m/Y \\a\\t H:i');
        }
        return $value;
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

    public function hasAttribute(string $attribute)
    {
        return array_key_exists($attribute, $this->attributes);
    }

    /**
     * Handles the publishing of a post by also setting the published date.
     *
     * @param bool $value
     */
    public function setStatusAttribute($value)
    {
        if ($value === 'published') {
            $this->setPublishedAtAttribute($value);
        }
        $this->attributes['status'] = $value;
    }

    /**
     * Sets the published date at the first time that the post is published.
     *
     * @param $value
     */
    public function setPublishedAtAttribute($value)
    {
        if ($value && !isset($this->published_at)) {
            $this->attributes['published_at'] = now();
        }
    }

    public function setDeletedAtAttribute($value)
    {
        $this->setStatusAttribute('trashed');
        $this->attributes['deleted_at'] = $value;
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
    public static function countAllStates() {
        return collect([
            'posts' => static::all()->count(),
            'published' => static::where('published', 1)->count(),
            'drafts' => static::where('published', 0)->count(),
            'trashed' => static::onlyTrashed()->count(),
        ]);
    }
}
