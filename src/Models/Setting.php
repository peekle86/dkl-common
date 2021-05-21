<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 * @method static CachedBuilder|Setting all($columns = [])
 * @method static CachedBuilder|Setting avg($column)
 * @method static CachedBuilder|Setting cache(array $tags = [])
 * @method static CachedBuilder|Setting cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Setting count($columns = '*')
 * @method static CachedBuilder|Setting disableCache()
 * @method static CachedBuilder|Setting disableModelCaching()
 * @method static CachedBuilder|Setting flushCache(array $tags = [])
 * @method static CachedBuilder|Setting getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder|Setting inRandomOrder($seed = '')
 * @method static CachedBuilder|Setting insert(array $values)
 * @method static CachedBuilder|Setting isCachable()
 * @method static CachedBuilder|Setting max($column)
 * @method static CachedBuilder|Setting min($column)
 * @method static CachedBuilder|Setting sum($column)
 * @method static CachedBuilder|Setting truncate()
 * @method static CachedBuilder|Setting withCacheCooldownSeconds(?int $seconds = null)
 * @property int $domain_id
 * @method static CachedBuilder|Setting whereDomainId($value)
 * @method static CachedBuilder|Setting byKey($key, $domain)
 */
class Setting extends Model
{
    use HasFactory;
    use Cachable;

    public function scopeByKey($query, $key, $domain)
    {
        return $query->where('key', $key)->where('domain_id', $domain);
    }
}
