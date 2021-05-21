<?php

namespace DKL\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * DKL\Models\Address
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $name
 * @property string|null $company
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $zip
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Address newModelQuery()
 * @method static Builder|Address newQuery()
 * @method static Builder|Address query()
 * @method static Builder|Address whereAddress($value)
 * @method static Builder|Address whereCity($value)
 * @method static Builder|Address whereCompany($value)
 * @method static Builder|Address whereCountry($value)
 * @method static Builder|Address whereState($value)
 * @method static Builder|Address whereCreatedAt($value)
 * @method static Builder|Address whereEmail($value)
 * @method static Builder|Address whereId($value)
 * @method static Builder|Address whereName($value)
 * @method static Builder|Address wherePhone($value)
 * @method static Builder|Address whereType($value)
 * @method static Builder|Address whereUpdatedAt($value)
 * @method static Builder|Address whereUserId($value)
 * @method static Builder|Address whereZip($value)
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'name',
        'company',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip',
    ];

    protected $appends = ['cityCountry', 'fullName'];

    protected function getCityCountryAttribute(): string
    {
        return $this->city . ', ' . $this->country;
    }

    protected function getAddressArAttribute(): array
    {
        return str_split($this->address, 40);
    }

    protected function getFullNameAttribute(): string
    {
        $fullName = [];
        if ($this->name) {
            $fullName[] = $this->name;
        }
        if ($this->company) {
            $fullName[] = $this->company;
        }
        return implode(', ', $fullName);
    }
}
