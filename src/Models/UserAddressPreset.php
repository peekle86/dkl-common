<?php


namespace DKL\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAddressPreset extends Model
{
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function scopeAny($query)
    {
        return $query;
    }

    public static function filter($filter = [], $domainId = 0)
    {
        $preset = self::any()->where('domain_id', $domainId);
        if (isset($filter['nickname'])) {
            $key = $filter['nickname'];
            $preset = $preset->where('nickname', 'like', '%' . $key . '%');
        }

        foreach (['name', 'address', 'city', 'country', 'type'] as $key) {
            if (array_key_exists($key, $filter)) {
                $keyFiltered = $filter[$key];
                $preset = $preset->whereHas(
                    'address',
                    function (Builder $query) use ($keyFiltered) {
                        $query->where('name', 'like', '%' . $keyFiltered . '%');
                    }
                );
            }
        }


        return $preset;
    }
}