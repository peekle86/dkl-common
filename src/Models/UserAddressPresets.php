<?php


namespace DKL\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAddressPresets extends Model
{
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}