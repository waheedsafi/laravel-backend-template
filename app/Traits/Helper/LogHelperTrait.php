<?php

namespace App\Traits\Helper;

use App\Jobs\LogUserLoginJob;

trait LogHelperTrait
{
    public function storeUserLog($request, $userable_id, $userable_type, $action)
    {
        $userAgent = $request->header('User-Agent');
        $browser = StringUtils::extractBrowserInfo($userAgent);
        $device = StringUtils::extractDeviceInfo($userAgent);
        LogUserLoginJob::dispatch(
            $userAgent,
            $userable_id,
            $userable_type,
            $action,
            $request->ip(),
            $browser,
            $device,
        );
    }
}
