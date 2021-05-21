<?php

namespace DKL\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\PriceRequest
 *
 * @method static Builder|PriceRequest newModelQuery()
 * @method static Builder|PriceRequest newQuery()
 * @method static Builder|PriceRequest query()
 * @property int $id
 * @property int $domain_id
 * @property string $sender_name
 * @property string|null $sender_company
 * @property string $sender_city
 * @property string $sender_email
 * @property string $sender_phone
 * @property string $sender_country
 * @property string $sender_state
 * @property string $sender_zip
 * @property string $recipient_city
 * @property string $recipient_country
 * @property string $recipient_state
 * @property string $recipient_zip
 * @property string $delivery_type
 * @property int $insurance_is_required
 * @property int $x
 * @property int $y
 * @property int $z
 * @property int $is_document
 * @property int $places
 * @property float $weight
 * @property float $insurance_price
 * @property string $insurance_currency
 * @property float $payment_price
 * @property string $payment_currency
 * @property string $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PriceRequest whereCreatedAt($value)
 * @method static Builder|PriceRequest whereDeliveryType($value)
 * @method static Builder|PriceRequest whereDomainId($value)
 * @method static Builder|PriceRequest whereId($value)
 * @method static Builder|PriceRequest whereInsuranceCurrency($value)
 * @method static Builder|PriceRequest whereInsuranceIsRequired($value)
 * @method static Builder|PriceRequest whereInsurancePrice($value)
 * @method static Builder|PriceRequest whereIsDocument($value)
 * @method static Builder|PriceRequest whereNotes($value)
 * @method static Builder|PriceRequest wherePaymentCurrency($value)
 * @method static Builder|PriceRequest wherePaymentPrice($value)
 * @method static Builder|PriceRequest wherePlaces($value)
 * @method static Builder|PriceRequest whereRecipientCity($value)
 * @method static Builder|PriceRequest whereRecipientCountry($value)
 * @method static Builder|PriceRequest whereRecipientState($value)
 * @method static Builder|PriceRequest whereRecipientZip($value)
 * @method static Builder|PriceRequest whereSenderCity($value)
 * @method static Builder|PriceRequest whereSenderCompany($value)
 * @method static Builder|PriceRequest whereSenderCountry($value)
 * @method static Builder|PriceRequest whereSenderState($value)
 * @method static Builder|PriceRequest whereSenderEmail($value)
 * @method static Builder|PriceRequest whereSenderName($value)
 * @method static Builder|PriceRequest whereSenderPhone($value)
 * @method static Builder|PriceRequest whereSenderZip($value)
 * @method static Builder|PriceRequest whereUpdatedAt($value)
 * @method static Builder|PriceRequest whereWeight($value)
 * @method static Builder|PriceRequest whereX($value)
 * @method static Builder|PriceRequest whereY($value)
 * @method static Builder|PriceRequest whereZ($value)
 * @property string|null $offer_price
 * @property string|null $offer_response
 * @method static Builder|PriceRequest whereOfferPrice($value)
 * @method static Builder|PriceRequest whereOfferResponse($value)
 * @property string|null $offer_currency
 * @property int|null $offer_is_sent
 * @property-read \DKL\Models\Domain $domain
 * @property-read string $admin_url
 * @property-read string $from
 * @property-read string $to
 * @method static Builder|PriceRequest any()
 * @method static Builder|PriceRequest whereOfferCurrency($value)
 * @method static Builder|PriceRequest whereOfferIsSent($value)
 */
class PriceRequest extends Model
{
    use HasFactory;

    protected $appends = [
        'from',
        'to'
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public static function filter($filter = [], $domainId = 0)
    {
        $priceRequests = self::any()->where('domain_id', $domainId);

        return $priceRequests;
    }

    public function getFromAttribute(): string
    {
        return $this->sender_city . ', ' . $this->sender_country;
    }

    public function getToAttribute(): string
    {
        return $this->recipient_city . ', ' . $this->recipient_country;
    }
}
