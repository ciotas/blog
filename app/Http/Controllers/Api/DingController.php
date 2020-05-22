<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DingController extends Controller
{
    public function pushMessage(Request $request)
    {
        $symbol = $request->symbol;
        $api = 'https://oapi.dingtalk.com/robot/send?access_token=9f809246656a6a8af7fff296986960a92fd0ace31ebef24ff44e467707a8be3d';
        $client = new Client();
        $response = $client->request('POST', $api, [
            'form_params' => [
                'msgtype' => 'text',
                'text' => [
                    'content' => $symbol.'关键价格已被触发，请持续留意！'
                ],
                'at' => [
                    'atMobiles' => [
                        '13071870889'
                    ],
                    "isAtAll" => false
                ]

            ]
        ]);
    }
}
