<?php

namespace DKL\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\TrackingHistory
 *
 * @property int $id
 * @property int $tracking_id
 * @property int $carrier_id
 * @property string $status
 * @property string|null $signature
 * @property string $status_date
 * @property string $status_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TrackingHistory newModelQuery()
 * @method static Builder|TrackingHistory newQuery()
 * @method static Builder|TrackingHistory query()
 * @method static Builder|TrackingHistory whereCarrierId($value)
 * @method static Builder|TrackingHistory whereCreatedAt($value)
 * @method static Builder|TrackingHistory whereId($value)
 * @method static Builder|TrackingHistory whereSignature($value)
 * @method static Builder|TrackingHistory whereStatus($value)
 * @method static Builder|TrackingHistory whereStatusDate($value)
 * @method static Builder|TrackingHistory whereStatusTime($value)
 * @method static Builder|TrackingHistory whereTrackingId($value)
 * @method static Builder|TrackingHistory whereUpdatedAt($value)
 * @property int|null $status_code
 * @method static Builder|TrackingHistory whereStatusCode($value)
 * @property int|null $hawb_id
 * @property string|null $location
 * @property-read Hawb|null $hawb
 * @method static Builder|TrackingHistory whereHawbId($value)
 * @method static Builder|TrackingHistory whereLocation($value)
 */
class TrackingHistory extends Model
{
    use HasFactory;

    protected $table = 'tracking_history';

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

    public function hawb(): BelongsTo
    {
        return $this->belongsTo(Hawb::class);
    }

    public function setValues(Tracking $tracking)
    {
        $this->attributes['tracking_id'] = $tracking->id;
        $this->attributes['hawb_id'] = $tracking->hawb_id;
        $this->attributes['status'] = $tracking->status;
        $this->attributes['status_code'] = $tracking->status_code;
        $this->attributes['notes'] = $tracking->notes;
        $this->attributes['location'] = $tracking->location;
        $this->attributes['signature'] = $tracking->signature;
        $this->attributes['status_date'] = $tracking->status_date;
        $this->attributes['status_time'] = $tracking->status_time;
    }
}
