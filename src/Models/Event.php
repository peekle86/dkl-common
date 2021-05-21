<?php

namespace DKL\Models;

use DKL\Constants\SettingsTypes;
use Carbon\Carbon;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

/**
 * DKL\Models\Event
 *
 * @property-read mixed $admin_url
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Collection|EventTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static CachedBuilder|Event all($columns = [])
 * @method static CachedBuilder|Event avg($column)
 * @method static CachedBuilder|Event cache(array $tags = [])
 * @method static CachedBuilder|Event cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Event count($columns = '*')
 * @method static CachedBuilder|Event disableCache()
 * @method static CachedBuilder|Event disableModelCaching()
 * @method static CachedBuilder|Event flushCache(array $tags = [])
 * @method static CachedBuilder|Event getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|Event inRandomOrder($seed = '')
 * @method static CachedBuilder|Event insert(array $values)
 * @method static CachedBuilder|Event isCachable()
 * @method static CachedBuilder|Event max($column)
 * @method static CachedBuilder|Event min($column)
 * @method static CachedBuilder|Event newModelQuery()
 * @method static CachedBuilder|Event newQuery()
 * @method static CachedBuilder|Event query()
 * @method static CachedBuilder|Event sum($column)
 * @method static CachedBuilder|Event truncate()
 * @method static CachedBuilder|Event withCacheCooldownSeconds(?int $seconds = null)
 * @property int $id
 * @property int $user_id
 * @property string $date_time
 * @property string $location
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CachedBuilder|Event whereCreatedAt($value)
 * @method static CachedBuilder|Event whereDateTime($value)
 * @method static CachedBuilder|Event whereId($value)
 * @method static CachedBuilder|Event whereLocation($value)
 * @method static CachedBuilder|Event whereUpdatedAt($value)
 * @method static CachedBuilder|Event whereUserId($value)
 * @property-read Collection|TeamMember[] $lecturers
 * @property-read int|null $lecturers_count
 * @property-read string $human_date
 * @method static Builder|Event onDate(Carbon $date)
 * @property-read string $image
 * @property-read \DKL\Models\EventTranslation $translation
 * @method static Builder|Event withLanguage($lang)
 * @property-read string $image_url
 * @property int $domain_id
 * @method static CachedBuilder|Event whereDomainId($value)
 */
class Event extends Model
{
    use HasFactory;

    use Cachable;

    /**
     * @var mixed
     */
    private static $lang;
    protected $cacheCooldownSeconds = 30000; // 500 minutes
    protected $appends = [
        'humanDate',
    ];

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            Image::class,
            'events_images',
            'event_id',
            'image_id',
            'id',
            'id'
        );
    }

    public function lecturers(): BelongsToMany
    {
        return $this->belongsToMany(
            TeamMemberTranslation::class,
            'events_lecturers',
            'event_id',
            'team_member_id',
            'id',
            'team_member_id'
        );
    }

    public function translations(): HasMany
    {
        return $this->hasMany(EventTranslation::class, 'event_id', 'id');
    }

    public function getHumanDateAttribute(): string
    {
        Carbon::setLocale(App::getLocale());

        return Carbon::parse($this->date_time)->format('G:i \o\n l jS F Y');
    }

    public function getTranslationAttribute(): EventTranslation
    {
        $langCode = self::$lang ?? App::getLocale();
        $language = Language::byDomain($this->domain_id)->whereCode($langCode)->first();

        $translation = self::translations()->whereLanguageId($language->id)->first();
        if ($translation->title == '') {
            $langCode = Setting::where('key', SettingsTypes::LANGUAGE_DEFAULT)->first()->value;
            $language = Language::whereCode($langCode)->first();
            $translation = self::translations()->whereLanguageId($language->id)->first();
        }
        return $translation;
    }

    public function scopeOnDate($query, Carbon $date)
    {
        $dateFrom = $date->clone()->hours(0)->minutes(0);
        $dateTill = $date->clone()->hours(23)->minutes(59);

        return $query->where('date_time', '>=', $dateFrom->toDateTimeString())
            ->where('date_time', '<=', $dateTill->toDateTimeString());
    }

    public function scopeWithLanguage($query, $lang)
    {
        $this->$lang = $lang;
    }
}
