<?php

namespace DKL\Models;

use DKL\Constants\TeamRoles;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\TeamMemberTranslation
 *
 * @property-read mixed $admin_url
 * @property-read mixed $url
 * @method static Builder|TeamMemberTranslation any()
 * @method static Builder|TeamMemberTranslation name($name = '', $languageId = null)
 * @method static Builder|TeamMemberTranslation newModelQuery()
 * @method static Builder|TeamMemberTranslation newQuery()
 * @method static Builder|TeamMemberTranslation query()
 * @property-read Language|null $language
 * @property-read TeamMember $teamMember
 * @property int $id
 * @property int $team_member_id
 * @property int $language_id
 * @property string $slug
 * @property string $name
 * @property string $position
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TeamMemberTranslation whereContent($value)
 * @method static Builder|TeamMemberTranslation whereCreatedAt($value)
 * @method static Builder|TeamMemberTranslation whereId($value)
 * @method static Builder|TeamMemberTranslation whereLanguageId($value)
 * @method static Builder|TeamMemberTranslation whereName($value)
 * @method static Builder|TeamMemberTranslation wherePosition($value)
 * @method static Builder|TeamMemberTranslation whereSlug($value)
 * @method static Builder|TeamMemberTranslation whereTeamMemberId($value)
 * @method static Builder|TeamMemberTranslation whereUpdatedAt($value)
 * @method static CachedBuilder|TeamMemberTranslation all($columns = [])
 * @method static CachedBuilder|TeamMemberTranslation avg($column)
 * @method static CachedBuilder|TeamMemberTranslation cache(array $tags = [])
 * @method static CachedBuilder|TeamMemberTranslation cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|TeamMemberTranslation count($columns = '*')
 * @method static CachedBuilder|TeamMemberTranslation disableCache()
 * @method static CachedBuilder|TeamMemberTranslation disableModelCaching()
 * @method static CachedBuilder|TeamMemberTranslation flushCache(array $tags = [])
 * @method static CachedBuilder|TeamMemberTranslation getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static CachedBuilder|TeamMemberTranslation inRandomOrder($seed = '')
 * @method static CachedBuilder|TeamMemberTranslation insert(array $values)
 * @method static CachedBuilder|TeamMemberTranslation isCachable()
 * @method static CachedBuilder|TeamMemberTranslation max($column)
 * @method static CachedBuilder|TeamMemberTranslation min($column)
 * @method static CachedBuilder|TeamMemberTranslation sum($column)
 * @method static CachedBuilder|TeamMemberTranslation truncate()
 * @method static CachedBuilder|TeamMemberTranslation withCacheCooldownSeconds(?int $seconds = null)
 * @method static CachedBuilder|TeamMemberTranslation lecturers()
 * @method static CachedBuilder|TeamMemberTranslation findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static CachedBuilder|TeamMemberTranslation withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
class TeamMemberTranslation extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function teamMember(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'team_member_id', 'id');
    }

    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public function scopeName($query, $name = '', $languageId = null)
    {
        $name = $name == '' ? '%' : '%' . $name . '%';

        return $query
            ->where('name', 'like', $name);
    }


    public static function filter($filter = [], $languageId = null)
    {
        $pageItem = self::any()->where('language_id', $languageId);
        if (isset($filter['name'])) {
            $title = $filter['name'] ?? '';
            $pageItem = $pageItem->title($title, $languageId);
        }

        return $pageItem;
    }

    public function scopeLecturers($query)
    {
        return $query->whereHas(
            'teamMember',
            function ($query) {
                return $query->lecturers();
            }
        );
    }
}
