<?php


namespace DKL\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAddressPreset extends Model
{
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}