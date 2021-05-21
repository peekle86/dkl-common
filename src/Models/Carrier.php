<?php

namespace DKL\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Carrier
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Carrier newModelQuery()
 * @method static Builder|Carrier newQuery()
 * @method static Builder|Carrier query()
 * @method static Builder|Carrier whereCode($value)
 * @method static Builder|Carrier whereCreatedAt($value)
 * @method static Builder|Carrier whereId($value)
 * @method static Builder|Carrier whereName($value)
 * @method static Builder|Carrier whereUpdatedAt($value)
 */
class Carrier extends Model
{
    use HasFactory;
}
