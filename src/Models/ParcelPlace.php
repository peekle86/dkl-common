<?php

namespace DKL\Models;

use Database\Factories\ParcelPlaceFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\ParcelPlace
 *
 * @property int $id
 * @property int $parcel_id
 * @property string $description
 * @property int $quantity
 * @property int $weight
 * @property int $x
 * @property int $y
 * @property int $z
 * @property int $is_document
 * @property float $price
 * @property string $currency
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ParcelPlace newModelQuery()
 * @method static Builder|ParcelPlace newQuery()
 * @method static Builder|ParcelPlace query()
 * @method static Builder|ParcelPlace whereCreatedAt($value)
 * @method static Builder|ParcelPlace whereCurrency($value)
 * @method static Builder|ParcelPlace whereDescription($value)
 * @method static Builder|ParcelPlace whereId($value)
 * @method static Builder|ParcelPlace whereIsDocument($value)
 * @method static Builder|ParcelPlace whereParcelId($value)
 * @method static Builder|ParcelPlace wherePrice($value)
 * @method static Builder|ParcelPlace whereQuantity($value)
 * @method static Builder|ParcelPlace whereType($value)
 * @method static Builder|ParcelPlace whereUpdatedAt($value)
 * @method static Builder|ParcelPlace whereWeight($value)
 * @method static Builder|ParcelPlace whereX($value)
 * @method static Builder|ParcelPlace whereY($value)
 * @method static Builder|ParcelPlace whereZ($value)
 */
class ParcelPlace extends Model
{
    use HasFactory;
}
