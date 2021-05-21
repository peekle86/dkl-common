<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Post
 *
 * @property-read Collection|Category[]       $categories
 * @property-read int|null                    $categories_count
 * @property-read mixed                       $admin_url
 * @property-read Collection|PostTranslation[] $translations
 * @property-read int|null                    $translations_count
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @property int                              $id
 * @property int                              $user_id
 * @property Carbon|null                      $created_at
 * @property Carbon|null                      $updated_at
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUserId($value)
 * @property string|null             $image
 * @method static Builder|Post whereImage($value)
 * @property-read Collection|Image[] $images
 * @property-read int|null           $images_count
 * @method static CachedBuilder|Post all($columns = [])
 * @method static CachedBuilder|Post avg($column)
 * @method static CachedBuilder|Post cache(array $tags = [])
 * @method static CachedBuilder|Post cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Post count($columns = '*')
 * @method static CachedBuilder|Post disableCache()
 * @method static CachedBuilder|Post disableModelCaching()
 * @method static CachedBuilder|Post flushCache(array $tags = [])
 * @method static CachedBuilder|Post getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|Post inRandomOrder($seed = '')
 * @method static CachedBuilder|Post insert(array $values)
 * @method static CachedBuilder|Post isCachable()
 * @method static CachedBuilder|Post max($column)
 * @method static CachedBuilder|Post min($column)
 * @method static CachedBuilder|Post sum($column)
 * @method static CachedBuilder|Post truncate()
 * @method static CachedBuilder|Post withCacheCooldownSeconds(?int $seconds = null)
 * @property int $domain_id
 * @method static CachedBuilder|Post whereDomainId($value)
 */
class Post extends Model
{
    use HasFactory;
    use Cachable;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'posts_categories',
            'post_id',
            'category_id'
        );
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            Image::class,
            'posts_images',
            'post_id',
            'image_id'
        );
    }

    protected $appends = ['adminUrl'];

    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class, 'post_id', 'id');
    }
}
