<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * DKL\Models\EventTranslation
 *
 * @property-read Event $event
 * @property-read mixed $admin_url
 * @property-read mixed $url
 * @property-read Language|null $language
 * @method static CachedBuilder|EventTranslation all($columns = [])
 * @method static CachedBuilder|EventTranslation any()
 * @method static CachedBuilder|EventTranslation avg($column)
 * @method static CachedBuilder|EventTranslation cache(array $tags = [])
 * @method static CachedBuilder|EventTranslation cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|EventTranslation count($columns = '*')
 * @method static CachedBuilder|EventTranslation disableCache()
 * @method static CachedBuilder|EventTranslation disableModelCaching()
 * @method static CachedBuilder|EventTranslation flushCache(array $tags = [])
 * @method static CachedBuilder|EventTranslation getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|EventTranslation inRandomOrder($seed = '')
 * @method static CachedBuilder|EventTranslation insert(array $values)
 * @method static CachedBuilder|EventTranslation isCachable()
 * @method static CachedBuilder|EventTranslation max($column)
 * @method static CachedBuilder|EventTranslation min($column)
 * @method static CachedBuilder|EventTranslation newModelQuery()
 * @method static CachedBuilder|EventTranslation newQuery()
 * @method static CachedBuilder|EventTranslation query()
 * @method static CachedBuilder|EventTranslation sum($column)
 * @method static CachedBuilder|EventTranslation title($title = '')
 * @method static CachedBuilder|EventTranslation truncate()
 * @method static CachedBuilder|EventTranslation withCacheCooldownSeconds(?int $seconds = null)
 * @property int $id
 * @property int $team_member_id
 * @property int $event_id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CachedBuilder|EventTranslation whereContent($value)
 * @method static CachedBuilder|EventTranslation whereCreatedAt($value)
 * @method static CachedBuilder|EventTranslation whereEventId($value)
 * @method static CachedBuilder|EventTranslation whereId($value)
 * @method static CachedBuilder|EventTranslation whereSlug($value)
 * @method static CachedBuilder|EventTranslation whereTeamMemberId($value)
 * @method static CachedBuilder|EventTranslation whereTitle($value)
 * @method static CachedBuilder|EventTranslation whereUpdatedAt($value)
 * @property int|null $language_id
 * @method static CachedBuilder|EventTranslation whereLanguageId($value)
 * @method static CachedBuilder|EventTranslation findSimilarSlugs(string $attribute, array $config, string $slug)
 * @property-read string $short_content
 * @method static CachedBuilder|EventTranslation withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
class EventTranslation extends Model
{
    use HasFactory;
    use Cachable;

    protected $appends = ['short_content'];

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
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
        $pageItem = self::any();
        if ($languageId) {
            $pageItem = $pageItem->where('language_id', $languageId);
        }
        if (isset($filter['title'])) {
            $title = $filter['title'] ?? '';
            $pageItem = $pageItem->title($title);
        }

        return $pageItem;
    }

    public function getShortContentAttribute(): string
    {
        return Str::words(strip_tags($this->content), 50);
    }
}
