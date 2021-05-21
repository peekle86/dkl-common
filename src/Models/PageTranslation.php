<?php

namespace DKL\Models;

use DKL\Page;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\PageTranslation
 *
 * @property int         $id
 * @property int         $page_id
 * @property int         $language_id
 * @property string      $title
 * @property string      $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Page   $page
 * @method static Builder|PageTranslation newModelQuery()
 * @method static Builder|PageTranslation newQuery()
 * @method static Builder|PageTranslation query()
 * @method static Builder|PageTranslation whereContent($value)
 * @method static Builder|PageTranslation whereCreatedAt($value)
 * @method static Builder|PageTranslation whereId($value)
 * @method static Builder|PageTranslation whereLanguageId($value)
 * @method static Builder|PageTranslation wherePageId($value)
 * @method static Builder|PageTranslation whereTitle($value)
 * @method static Builder|PageTranslation whereUpdatedAt($value)
 * @property string|null        $slug
 * @property-read mixed         $admin_url
 * @property-read Language|null $language
 * @method static Builder|PageTranslation any()
 * @method static Builder|PageTranslation title($title = '', $languageId = null)
 * @method static Builder|PageTranslation whereSlug($value)
 * @property-read mixed $url
 * @method static CachedBuilder|PageTranslation all($columns = [])
 * @method static CachedBuilder|PageTranslation avg($column)
 * @method static CachedBuilder|PageTranslation cache(array $tags = [])
 * @method static CachedBuilder|PageTranslation cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|PageTranslation count($columns = '*')
 * @method static CachedBuilder|PageTranslation disableCache()
 * @method static CachedBuilder|PageTranslation disableModelCaching()
 * @method static CachedBuilder|PageTranslation flushCache(array $tags = [])
 * @method static CachedBuilder|PageTranslation getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|PageTranslation inRandomOrder($seed = '')
 * @method static CachedBuilder|PageTranslation insert(array $values)
 * @method static CachedBuilder|PageTranslation isCachable()
 * @method static CachedBuilder|PageTranslation max($column)
 * @method static CachedBuilder|PageTranslation min($column)
 * @method static CachedBuilder|PageTranslation sum($column)
 * @method static CachedBuilder|PageTranslation truncate()
 * @method static CachedBuilder|PageTranslation withCacheCooldownSeconds(?int $seconds = null)
 * @method static CachedBuilder|PageTranslation findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static CachedBuilder|PageTranslation withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
class PageTranslation extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public function scopeTitle($query, $title = '', $languageId = null)
    {
        $title = $title == '' ? '%' : '%'.$title.'%';

        return $query
            ->where('title', 'like', $title);
    }


    public static function filter($filter = [], $languageId = null)
    {
        $pageItem = self::any()->where('language_id', $languageId);
        if (isset($filter['title'])) {
            $title = $filter['title'] ?? '';
            $pageItem = $pageItem->title($title, $languageId);
        }

        return $pageItem;
    }
}
