<?php

namespace Src\Actions;

use Src\Database\UserAnalytics;

class GetUserAnalytics
{
    public static function exec()
    {
        $userAnalytics = new UserAnalytics();
        $data = [];
        $data['count_by_city'] = $userAnalytics->selectCountByCity();
        $data['ip_by_hour'] = $userAnalytics->selectCountDistinctIpByHour();

        return json_encode(['data' => $data]);
    }
}