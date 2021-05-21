<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\PostTranslation
 *
 * @property-read mixed $admin_url
 * @property-read Language|null $language
 * @property-read Post $page
 * @method static Builder|PostTranslation any()
 * @method static Builder|PostTranslation newModelQuery()
 * @method static Builder|PostTranslation newQuery()
 * @method static Builder|PostTranslation query()
 * @method static Builder|PostTranslation title($title = '', $languageId = null)
 * @property int $id
 * @property int $post_id
 * @property int $language_id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PostTranslation whereContent($value)
 * @method static Builder|PostTranslation whereCreatedAt($value)
 * @method static Builder|PostTranslation whereId($value)
 * @method static Builder|PostTranslation whereLanguageId($value)
 * @method static Builder|PostTranslation wherePostId($value)
 * @method static Builder|PostTranslation whereSlug($value)
 * @method static Builder|PostTranslation whereTitle($value)
 * @method static Builder|PostTranslation whereUpdatedAt($value)
 * @property-read mixed $url
 * @property-read Post $post
 * @method static CachedBuilder|PostTranslation all($columns = [])
 * @method static CachedBuilder|PostTranslation avg($column)
 * @method static CachedBuilder|PostTranslation cache(array $tags = [])
 * @method static CachedBuilder|PostTranslation cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|PostTranslation count($columns = '*')
 * @method static CachedBuilder|PostTranslation disableCache()
 * @method static CachedBuilder|PostTranslation disableModelCaching()
 * @method static CachedBuilder|PostTranslation flushCache(array $tags = [])
 * @method static CachedBuilder|PostTranslation getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|PostTranslation inRandomOrder($seed = '')
 * @method static CachedBuilder|PostTranslation insert(array $values)
 * @method static CachedBuilder|PostTranslation isCachable()
 * @method static CachedBuilder|PostTranslation max($column)
 * @method static CachedBuilder|PostTranslation min($column)
 * @method static CachedBuilder|PostTranslation sum($column)
 * @method static CachedBuilder|PostTranslation truncate()
 * @method static CachedBuilder|PostTranslation withCacheCooldownSeconds(?int $seconds = null)
 * @method static CachedBuilder|PostTranslation findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static CachedBuilder|PostTranslation withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
class PostTranslation extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public function scopeTitle($query, $title = '')
    {
        $title = $title == '' ? '%' : '%' . $title . '%';

        return $query
            ->where('title', 'like', $title);
    }


    public static function filter($filter = [], $languageId = null)
    {
        $pageItem = self::any()->where('language_id', $languageId);
        if (isset($filter['title'])) {
            $title = $filter['title'] ?? '';
            $pageItem = $pageItem->title($title);
        }

        return $pageItem;
    }
}
