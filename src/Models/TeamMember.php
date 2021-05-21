<?php

namespace DKL\Models;

use DKL\Constants\TeamRoles;
use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\TeamMember
 *
 * @property-read mixed $admin_url
 * @property-read Collection|TeamMemberTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|TeamMember newModelQuery()
 * @method static Builder|TeamMember newQuery()
 * @method static Builder|TeamMember query()
 * @property int $id
 * @property int $user_id
 * @property string $image
 * @property string $email
 * @property string $phone_number
 * @property string $facebook
 * @property string $linkedin
 * @property string $twitter
 * @property string $instagram
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TeamMember whereCreatedAt($value)
 * @method static Builder|TeamMember whereEmail($value)
 * @method static Builder|TeamMember whereFacebook($value)
 * @method static Builder|TeamMember whereId($value)
 * @method static Builder|TeamMember whereImage($value)
 * @method static Builder|TeamMember whereInstagram($value)
 * @method static Builder|TeamMember whereLinkedin($value)
 * @method static Builder|TeamMember wherePhoneNumber($value)
 * @method static Builder|TeamMember whereTwitter($value)
 * @method static Builder|TeamMember whereUpdatedAt($value)
 * @method static Builder|TeamMember whereUserId($value)
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @method static CachedBuilder|TeamMember all($columns = [])
 * @method static CachedBuilder|TeamMember avg($column)
 * @method static CachedBuilder|TeamMember cache(array $tags = [])
 * @method static CachedBuilder|TeamMember cachedValue(array $arguments, string $cacheKey)
 * @method static CachedBuilder|TeamMember count($columns = '*')
 * @method static CachedBuilder|TeamMember disableCache()
 * @method static CachedBuilder|TeamMember disableModelCaching()
 * @method static CachedBuilder|TeamMember flushCache(array $tags = [])
 * @method static CachedBuilder|TeamMember getModelCacheCooldown(Model $instance)
 * @method static CachedBuilder|TeamMember inRandomOrder($seed = '')
 * @method static CachedBuilder|TeamMember insert(array $values)
 * @method static CachedBuilder|TeamMember isCachable()
 * @method static CachedBuilder|TeamMember max($column)
 * @method static CachedBuilder|TeamMember min($column)
 * @method static CachedBuilder|TeamMember sum($column)
 * @method static CachedBuilder|TeamMember truncate()
 * @method static CachedBuilder|TeamMember withCacheCooldownSeconds(?int $seconds = null)
 * @property-read Collection|TeamRole[] $roles
 * @property-read int|null $roles_count
 * @property-read Collection|TeamRole[] $teamRoles
 * @property-read int|null $team_roles_count
 * @method static CachedBuilder|TeamMember lecturers()
 * @method static CachedBuilder|TeamMember roles()
 * @property-read Collection|Event[] $events
 * @property-read int|null $events_count
 * @method static CachedBuilder|TeamMember communityLeaders()
 * @property-read string $image_url
 * @property int $domain_id
 * @method static CachedBuilder|TeamMember whereDomainId($value)
 */
class TeamMember extends Model
{
    use HasFactory;
    use Cachable;

    protected $cacheCooldownSeconds = 30000; // 500 minutes

    public function translations(): HasMany
    {
        return $this->hasMany(TeamMemberTranslation::class, 'team_member_id', 'id');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            Image::class,
            'team_members_images',
            'team_member_id',
            'image_id',
            'id',
            'id'
        );
    }

    public function teamRoles(): BelongsToMany
    {
        return $this->belongsToMany(
            TeamRole::class,
            'team_members_roles',
            'team_member_id',
            'team_role_id',
            'id',
            'id'
        );
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'events_lecturers',
            'team_member_id',
            'event_id',
            'id',
            'id'
        );
    }

    public function scopeRoles($query)
    {
        return $query->with("teamRoles")->get();
    }

    public function scopeLecturers($query)
    {
        return $query->whereHas(
            "teamRoles",
            function ($query) {
                return $query->where('code', TeamRoles::LECTURER);
            }
        );
    }

    public function scopeCommunityLeaders($query)
    {
        return $query->whereHas(
            "teamRoles",
            function ($query) {
                return $query->where('code', TeamRoles::COMMUNITY_LEADER);
            }
        );
    }

}
