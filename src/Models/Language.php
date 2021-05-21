<?php

namespace DKL\Models;

use DKL\Constants\SettingsTypes;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Language
 *
 * @property int                             $id
 * @property string                          $code
 * @property string                          $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Language newModelQuery()
 * @method static Builder|Language newQuery()
 * @method static Builder|Language query()
 * @method static Builder|Language whereCode($value)
 * @method static Builder|Language whereCreatedAt($value)
 * @method static Builder|Language whereId($value)
 * @method static Builder|Language whereName($value)
 * @method static Builder|Language whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read mixed $default
 * @method static CachedBuilder|Language all($columns = [])
 * @method static CachedBuilder|Language avg($column)
 * @method static CachedBuilder|Language cache(array $tags = [])
 * @method static CachedBuilder|Language cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Language count($columns = '*')
 * @method static CachedBuilder|Language disableCache()
 * @method static CachedBuilder|Language disableModelCaching()
 * @method static CachedBuilder|Language flushCache(array $tags = [])
 * @method static CachedBuilder|Language getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|Language inRandomOrder($seed = '')
 * @method static CachedBuilder|Language insert(array $values)
 * @method static CachedBuilder|Language isCachable()
 * @method static CachedBuilder|Language max($column)
 * @method static CachedBuilder|Language min($column)
 * @method static CachedBuilder|Language sum($column)
 * @method static CachedBuilder|Language truncate()
 * @method static CachedBuilder|Language withCacheCooldownSeconds(?int $seconds = null)
 * @property int $domain_id
 * @method static CachedBuilder|Language whereDomainId($value)
 * @method static CachedBuilder|Language byDomain($domain)
 */
class Language extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    protected $appends = ['default'];

    public function getDefaultAttribute()
    {
        return Setting::where(['key' => SettingsTypes::LANGUAGE_DEFAULT, 'value' => $this->code])->count() > 0;
    }

    public function scopeByDomain($query, $domain)
    {
        return $query->where('domain_id', $domain);
    }
}
