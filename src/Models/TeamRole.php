<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\TeamRole
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CachedBuilder|TeamRole all($columns = [])
 * @method static CachedBuilder|TeamRole avg($column)
 * @method static CachedBuilder|TeamRole cache(array $tags = [])
 * @method static CachedBuilder|TeamRole cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|TeamRole count($columns = '*')
 * @method static CachedBuilder|TeamRole disableCache()
 * @method static CachedBuilder|TeamRole disableModelCaching()
 * @method static CachedBuilder|TeamRole flushCache(array $tags = [])
 * @method static CachedBuilder|TeamRole getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|TeamRole inRandomOrder($seed = '')
 * @method static CachedBuilder|TeamRole insert(array $values)
 * @method static CachedBuilder|TeamRole isCachable()
 * @method static CachedBuilder|TeamRole max($column)
 * @method static CachedBuilder|TeamRole min($column)
 * @method static CachedBuilder|TeamRole newModelQuery()
 * @method static CachedBuilder|TeamRole newQuery()
 * @method static CachedBuilder|TeamRole query()
 * @method static CachedBuilder|TeamRole sum($column)
 * @method static CachedBuilder|TeamRole truncate()
 * @method static CachedBuilder|TeamRole whereCode($value)
 * @method static CachedBuilder|TeamRole whereCreatedAt($value)
 * @method static CachedBuilder|TeamRole whereId($value)
 * @method static CachedBuilder|TeamRole whereName($value)
 * @method static CachedBuilder|TeamRole whereUpdatedAt($value)
 * @method static CachedBuilder|TeamRole withCacheCooldownSeconds(?int $seconds = null)
 * @property-read Collection|TeamMember[] $teamMembers
 * @property-read int|null $team_members_count
 */
class TeamRole extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(
            TeamMember::class,
            'team_members_roles',
            'role_id',
            'team_member_id',
            'id',
            'id'
        );
    }

}
