<?php

namespace Src\Actions;

use Src\Database\UserAnalytics;

class CreateAndFillUserAnalytics
{
    public static function exec()
    {
        $userAnalytics = new UserAnalytics();
        $userAnalytics->createTable();


        $someInsertData = [
            [
                'ip4' => '115.28.45.68',
                'city' => 'Paris',
                'platform' => 'Windows 11'
            ],
            [
                'ip4' => '234.28.105.68',
                'city' => 'Kazan',
                'platform' => 'Android 14'
            ],
            [
                'ip4' => '85.43.45.68',
                'city' => 'London',
                'platform' => 'Windows 11'
            ],
            [
                'ip4' => '105.10.45.1',
                'city' => 'Moscow',
                'platform' => 'Windows 11'
            ],
            [
                'ip4' => '12.45.14.12',
                'city' => 'Kazan',
                'platform' => 'Android 10'
            ],
            [
                'ip4' => '10.10.10.10',
                'city' => 'Moscow',
                'platform' => 'Windows 11'
            ],
            [
                'ip4' => '100.101.102.103',
                'city' => 'Moscow',
                'platform' => 'Linux 86_64'
            ],
            [
                'ip4' => '26.45.65.85',
                'city' => 'Kazan',
                'platform' => 'Linux 86_64'
            ],
            [
                'ip4' => '202.201.200.199',
                'city' => 'Moscow',
                'platform' => 'Windows 11'
            ],
            [
                'ip4' => '118.34.99.12',
                'city' => 'Irkutsk',
                'platform' => 'Linux 86_64'
            ],
            [
                'ip4' => '164.154.121.181',
                'city' => 'Ufa',
                'platform' => 'Windows 10'
            ],
        ];


        foreach($someInsertData as $insertData){
            $userAnalytics->insert($insertData);
        }
        return 'Создано';
    }
}