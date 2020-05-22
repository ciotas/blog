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
        $body = [
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

        ];
        $data_string = \GuzzleHttp\json_encode($body);

        $result = $this->request_by_curl($api, $data_string);
        return $result;

    }

    private function request_by_curl($remote_server, $post_string) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
