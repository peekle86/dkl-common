<?php

namespace DKL\Models;

use Database\Factories\ParcelFactory;
use DKL\Constants\DeliveryTypes;
use DKL\Helpers\ParcelHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Parcel
 *
 * @property int $id
 * @property int $user_id
 * @property int $domain_id
 * @property int $sender_address_id
 * @property int $recipient_address_id
 * @property int|null $third_party_address_id
 * @property string $delivery_type
 * @property int $insurance_is_required
 * @property float $insurance_price
 * @property string $insurance_currency
 * @property string $export_reason
 * @property string $export_conditions
 * @property string $payment_type
 * @property string $payment_part
 * @property int $payment_on_delivery
 * @property float $payment_price
 * @property string $payment_currency
 * @property string $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|ParcelPlace[] $places
 * @property-read int|null $places_count
 * @property-read Address $recipientAddress
 * @property-read Address $senderAddress
 * @property-read Address|null $thirdPartyAddress
 * @method static Builder|Parcel newModelQuery()
 * @method static Builder|Parcel newQuery()
 * @method static Builder|Parcel query()
 * @method static Builder|Parcel whereCreatedAt($value)
 * @method static Builder|Parcel whereDeliveryType($value)
 * @method static Builder|Parcel whereDomainId($value)
 * @method static Builder|Parcel whereExportConditions($value)
 * @method static Builder|Parcel whereExportReason($value)
 * @method static Builder|Parcel whereId($value)
 * @method static Builder|Parcel whereInsuranceCurrency($value)
 * @method static Builder|Parcel whereInsuranceIsRequired($value)
 * @method static Builder|Parcel whereInsurancePrice($value)
 * @method static Builder|Parcel whereNotes($value)
 * @method static Builder|Parcel wherePaymentCurrency($value)
 * @method static Builder|Parcel wherePaymentOnDelivery($value)
 * @method static Builder|Parcel wherePaymentPart($value)
 * @method static Builder|Parcel wherePaymentPrice($value)
 * @method static Builder|Parcel wherePaymentType($value)
 * @method static Builder|Parcel whereRecipientAddressId($value)
 * @method static Builder|Parcel whereSenderAddressId($value)
 * @method static Builder|Parcel whereThirdPartyAddressId($value)
 * @method static Builder|Parcel whereUpdatedAt($value)
 * @method static Builder|Parcel whereUserId($value)
 * @method static Builder|Parcel any()
 * @property-read Collection|Hawb[] $hawbs
 * @property-read int|null $hawbs_count
 * @property-read string $admin_url
 * @property-read Tracking|null $tracking
 * @property string|null $shipment_type
 * @property-read string $dkl_hawb
 * @property-read string $is_document
 * @property-read string $total_quantity
 * @property-read string $total_weight
 * @property-read string $volumentric_weight
 * @method static Builder|Parcel whereShipmentType($value)
 */
class Parcel extends Model
{
    use HasFactory;

    protected $appends = [
        'isDocument',
        'totalQuantity',
        'totalWeight',
        'volumentricWeight',
        'dklHawb',
    ];

    /**
     * @return HasMany
     */
    public function places(): HasMany
    {
        return $this->hasMany(ParcelPlace::class);
    }

    public function hawbs(): HasMany
    {
        return $this->hasMany(Hawb::class);
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function tracking(): HasOne
    {
        return $this->hasOne(Tracking::class);
    }

    public function senderAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'sender_address_id', 'id');
    }

    public function recipientAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'recipient_address_id', 'id');
    }

    public function thirdPartyAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'third_party_address_id', 'id');
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public static function filter($filter = [], $domainId = 0)
    {
        $parcel = self::any()->where('domain_id', $domainId);
        if (isset($filter['hawb'])) {
            $key = $filter['hawb'];
            $parcel = $parcel->whereHas(
                'hawbs',
                function (Builder $query) use ($key) {
                    $query->where('number', 'like', '%' . $key . '%');
                }
            );
        }

        if (isset($filter['sender'])) {
            $key = $filter['sender'];
            $parcel = $parcel->whereHas(
                'senderAddress',
                function (Builder $query) use ($key) {
                    $query->where('name', 'like', '%' . $key . '%')
                        ->orWhere('company', 'like', '%' . $key . '%');
                }
            );
        }

        if (isset($filter['recipient'])) {
            $key = $filter['recipient'];
            $parcel = $parcel->whereHas(
                'recipientAddress',
                function (Builder $query) use ($key) {
                    $query->where('name', 'like', '%' . $key . '%');
                }
            );
        }

        if (isset($filter['from'])) {
            $key = $filter['from'];
            $parcel = $parcel->whereHas(
                'senderAddress',
                function (Builder $query) use ($key) {
                    $query->where('city', 'like', '%' . $key . '%')
                        ->orWhere('country', 'like', '%' . $key . '%');
                }
            );
        }

        if (isset($filter['to'])) {
            $key = $filter['to'];
            $parcel = $parcel->whereHas(
                'recipientAddress',
                function (Builder $query) use ($key) {
                    $query->where('city', 'like', '%' . $key . '%')
                        ->orWhere('country', 'like', '%' . $key . '%');
                }
            );
        }

        if (isset($filter['starting'])) {
            $key = $filter['starting'];
            $parcel = $parcel->where('created_at', '>=', $key);
        }
        if (isset($filter['till'])) {
            $key = $filter['till'];
            $parcel = $parcel->where('created_at', '<=', $key);
        }

        return $parcel;
    }

    public function getIsDocumentAttribute(): string
    {
        if (!isset($this->places)) {
            return false;
        }
        return $this->places->every(
            function ($place) {
                return $place->is_document == 1;
            }
        );
    }

    public function getTotalQuantityAttribute(): string
    {
        return $this->places->sum(
            function ($place) {
                return $place->quantity;
            }
        );
    }

    public function getTotalWeightAttribute(): string
    {
        return $this->places->sum(
            function ($place) {
                return $place->weight;
            }
        );
    }

    public function getVolumentricWeightAttribute(): string
    {
        return ParcelHelpers::volumetricWeight($this->delivery_type, $this->places);
    }

    public function getDklHawbAttribute(): string
    {
        $dklId = Carrier::whereCode('dkl')->first()->id;
        $hawb = $this->hawbs->first(
            function ($hawb) use ($dklId) {
                return $hawb->carrier_id == $dklId;
            }
        );
        if ($hawb) {
            return $hawb->number;
        }

        return '';
    }
}
