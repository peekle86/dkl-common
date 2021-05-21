<?php

namespace DKL\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Hawb
 *
 * @property int $id
 * @property int $parcel_id
 * @property int $domain_id
 * @property int $carrier_id
 * @property string $number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Hawb newModelQuery()
 * @method static Builder|Hawb newQuery()
 * @method static Builder|Hawb query()
 * @method static Builder|Hawb whereCarrierId($value)
 * @method static Builder|Hawb whereCreatedAt($value)
 * @method static Builder|Hawb whereDomainId($value)
 * @method static Builder|Hawb whereId($value)
 * @method static Builder|Hawb whereNumber($value)
 * @method static Builder|Hawb whereParcelId($value)
 * @method static Builder|Hawb whereUpdatedAt($value)
 * @property-read Carrier $carrier
 * @property-read Parcel $parcel
 */
class Hawb extends Model
{
    protected $with = ['carrier'];

    public function carrier(): BelongsTo
    {
        return $this->belongsTo(Carrier::class);
    }

    public function parcel(): BelongsTo
    {
        return $this->belongsTo(Parcel::class);
    }
}
