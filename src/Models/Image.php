<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Image
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereName($value)
 * @method static Builder|Image wherePath($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @property-read mixed $url
 * @property-read Collection|Post[] $posts
 * @property-read int|null $posts_count
 * @method static Builder|Image any()
 * @method static Builder|Image title($name = '')
 * @method static CachedBuilder|Image all($columns = [])
 * @method static CachedBuilder|Image avg($column)
 * @method static CachedBuilder|Image cache(array $tags = [])
 * @method static CachedBuilder|Image cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|Image count($columns = '*')
 * @method static CachedBuilder|Image disableCache()
 * @method static CachedBuilder|Image disableModelCaching()
 * @method static CachedBuilder|Image flushCache(array $tags = [])
 * @method static CachedBuilder|Image getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|Image inRandomOrder($seed = '')
 * @method static CachedBuilder|Image insert(array $values)
 * @method static CachedBuilder|Image isCachable()
 * @method static CachedBuilder|Image max($column)
 * @method static CachedBuilder|Image min($column)
 * @method static CachedBuilder|Image sum($column)
 * @method static CachedBuilder|Image truncate()
 * @method static CachedBuilder|Image withCacheCooldownSeconds(?int $seconds = null)
 * @property-read Collection|\DKL\Models\TeamMember[] $teamMembers
 * @property-read int|null $team_members_count
 * @property-read Collection|\DKL\Models\Event[] $events
 * @property-read int|null $events_count
 * @property string $thumb
 * @method static CachedBuilder|Image whereThumb($value)
 */
class Image extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    protected $appends = ['url'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'posts_images',
            'image_id',
            'post_id'
        );
    }

    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(
            TeamMember::class,
            'team_members_images',
            'image_id',
            'team_member_id',
            'id',
            'id'
        );
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'events_images',
            'image_id',
            'event_id',
            'id',
            'id'
        );
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public function scopeTitle($query, $name = '')
    {
        $name = $name == '' ? '%' : '%' . $name . '%';

        return $query
            ->where('name', 'like', $name);
    }


    public static function filter($filter = [])
    {
        $pageItem = self::any();
        if (isset($filter['name'])) {
            $name = $filter['name'] ?? '';
            $pageItem = $pageItem->title($name);
        }

        return $pageItem;
    }
}
