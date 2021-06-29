<?php


namespace DKL\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourierCall extends Model
{
    public function parcel(): HasOne
    {
        return $this->hasOne(Parcel::class);
    }

    public function session(): HasOne
    {
        return $this->hasOne(Session::class, 'session_id', 'session_id');
    }
}