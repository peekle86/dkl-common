<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Menu
 *
 * @property int $id
 * @property string $type
 * @property mixed $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $admin_url
 * @method static Builder|Menu any()
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu query()
 * @method static Builder|Menu whereContent($value)
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereType($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @method static CachedBuilder|Menu all($columns = [])
 * @method static CachedBuilder|Menu avg($column)
 * @method static CachedBuilder|Menu cache(array $tags = [])
 * @method static CachedBuilder|Menu cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Menu count($columns = '*')
 * @method static CachedBuilder|Menu disableCache()
 * @method static CachedBuilder|Menu disableModelCaching()
 * @method static CachedBuilder|Menu flushCache(array $tags = [])
 * @method static CachedBuilder|Menu getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|Menu inRandomOrder($seed = '')
 * @method static CachedBuilder|Menu insert(array $values)
 * @method static CachedBuilder|Menu isCachable()
 * @method static CachedBuilder|Menu max($column)
 * @method static CachedBuilder|Menu min($column)
 * @method static CachedBuilder|Menu sum($column)
 * @method static CachedBuilder|Menu truncate()
 * @method static CachedBuilder|Menu withCacheCooldownSeconds(?int $seconds = null)
 * @property int $domain_id
 * @method static CachedBuilder|Menu whereDomainId($value)
 */
class Menu extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function scopeAny($query)
    {
        return $query;
    }
}
