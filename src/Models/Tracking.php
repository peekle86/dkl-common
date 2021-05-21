<?php

namespace DKL\Models;

use DKL\Constants\TrackingStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Tracking
 *
 * @property int $id
 * @property int $parcel_id
 * @property int $carrier_id
 * @property string $status
 * @property string|null $signature
 * @property string $status_date
 * @property string $status_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Tracking newModelQuery()
 * @method static Builder|Tracking newQuery()
 * @method static Builder|Tracking query()
 * @method static Builder|Tracking whereCarrierId($value)
 * @method static Builder|Tracking whereCreatedAt($value)
 * @method static Builder|Tracking whereId($value)
 * @method static Builder|Tracking whereParcelId($value)
 * @method static Builder|Tracking whereSignature($value)
 * @method static Builder|Tracking whereStatus($value)
 * @method static Builder|Tracking whereStatusDate($value)
 * @method static Builder|Tracking whereStatusTime($value)
 * @method static Builder|Tracking whereUpdatedAt($value)
 * @property int|null $status_code
 * @method static Builder|Tracking whereStatusCode($value)
 * @property int|null $hawb_id
 * @property string|null $location
 * @property-read Hawb|null $hawb
 * @property-read Collection|TrackingHistory[] $trackingHistory
 * @property-read int|null $tracking_history_count
 * @method static Builder|Tracking whereHawbId($value)
 * @method static Builder|Tracking whereLocation($value)
 * @property-read Parcel $parcel
 */
class Tracking extends Model
{
    use HasFactory;

    protected $table = 'tracking';
    protected $with = ['hawb'];

    protected $fillable = [
        'tracking_id',
        'hawb_id',
        'status',
        'status_code',
        'location',
        'signature',
        'status_date',
        'status_time',
    ];

    public function trackingHistory(): HasMany
    {
        return $this->hasMany(TrackingHistory::class);
    }

    public function hawb(): BelongsTo
    {
        return $this->belongsTo(Hawb::class);
    }

    public function parcel(): BelongsTo
    {
        return $this->belongsTo(Parcel::class);
    }

    public function scopeNotDelivered(Builder $query): Builder
    {
        return $query->where('status_code', '!=', TrackingStatuses::DELIVERED);
    }
}
