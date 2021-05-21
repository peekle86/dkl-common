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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Page
 *
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|PageTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|Page newModelQuery()
 * @method static Builder|Page newQuery()
 * @method static Builder|Page query()
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereUpdatedAt($value)
 * @method static Builder|Page whereUserId($value)
 * @property-read mixed $admin_url
 * @method static CachedBuilder|Page all($columns = [])
 * @method static CachedBuilder|Page avg($column)
 * @method static CachedBuilder|Page cache(array $tags = [])
 * @method static CachedBuilder|Page cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Page count($columns = '*')
 * @method static CachedBuilder|Page disableCache()
 * @method static CachedBuilder|Page disableModelCaching()
 * @method static CachedBuilder|Page flushCache(array $tags = [])
 * @method static CachedBuilder|Page getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|Page inRandomOrder($seed = '')
 * @method static CachedBuilder|Page insert(array $values)
 * @method static CachedBuilder|Page isCachable()
 * @method static CachedBuilder|Page max($column)
 * @method static CachedBuilder|Page min($column)
 * @method static CachedBuilder|Page sum($column)
 * @method static CachedBuilder|Page truncate()
 * @method static CachedBuilder|Page withCacheCooldownSeconds(?int $seconds = null)
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read string $image_url
 * @property int $domain_id
 * @method static CachedBuilder|Page whereDomainId($value)
 */
class Page extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            Image::class,
            'pages_images',
            'page_id',
            'image_id'
        );
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PageTranslation::class, 'page_id', 'id');
    }
}
