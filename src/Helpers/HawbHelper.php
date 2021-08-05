<?php

namespace DKL\Helpers;

use DKL\Models\Carrier;
use DKL\Models\Domain;
use DKL\Models\Hawb;
use Carbon\Carbon;

class HawbHelper
{
    public static function findNextHawbNumber($domainId)
    {
        $domain = Domain::find($domainId);
        $prefix = $domain->hawb_prefix;
        $today_date = Carbon::now()->format('ym');
        $hawbNum = $today_date . '00500';

        $carrier = Carrier::whereCode('dkl')->first();
        $hawb = Hawb::whereDomainId($domainId)
            ->whereCarrierId($carrier->id)
            ->latest()
            ->first();
        if ($hawb) {
            if (preg_match("/^$prefix.*/", $hawb->number)) {
                $int = preg_replace("/^$prefix(.*)/", "$1", $hawb->number);
            }
            $hawbNum = preg_replace('/^\w{0,4}/', $today_date, $int);
            $hawbNum++;
        }

        return $prefix . $hawbNum;
    }
}
