<?php

namespace DKL\Models;

use GeneaLabs\LaravelModelCaching\CachedBuilder;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Domain
 *
 * @method static Builder|Domain newModelQuery()
 * @method static Builder|Domain newQuery()
 * @method static Builder|Domain query()
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CachedBuilder|Domain whereCreatedAt($value)
 * @method static CachedBuilder|Domain whereId($value)
 * @method static CachedBuilder|Domain whereName($value)
 * @method static CachedBuilder|Domain whereUpdatedAt($value)
 * @property string|null $hawb_prefix
 * @method static CachedBuilder|Domain whereHawbPrefix($value)
 */
class Domain extends Model
{
    use HasFactory;
    use Cachable;
}
