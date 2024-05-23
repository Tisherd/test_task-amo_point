<?php

namespace Src\Actions;

use Src\Database\UserAnalytics;

class CollectUserAnalytics
{
    public static function exec()
    {
        
        try {
            $userAnalytics = new UserAnalytics();
            $userAnalytics->createTable();

            $post = json_decode(file_get_contents('php://input'), true);

            $insertData = [
                'ip4' => $post['ip4'],
                'city' => $post['city'],
                'platform' => $post['platform'],
            ];
            $userAnalytics->insert($insertData);

            $response = ['status' => 'COLLECTED'];

        } catch (\Throwable $th) {
            $response = [
                'status' => 'NOT_COLLECTED',
                'error_msg' => $th->getMessage(), 
            ];
        }
        
        return json_encode($response);
    }
}