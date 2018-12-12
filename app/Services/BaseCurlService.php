<?php

namespace App\Services;

class BaseCurlService
{
    /**
     * 送出POST請求
     *
     * @param array   $requestData 送出的資料
     * @param string  $url         送出請求的網址
     * @param integer $port        埠號
     * @return void
     */
    public function postToCurl($requestData, $url, $port = '443')
    {
        $objCurl = curl_init();

        $optCurl = array();
        $optCurl[CURLOPT_URL] = $url;
        $optCurl[CURLOPT_POST] = true;
        $optCurl[CURLOPT_POSTFIELDS] = $requestData;
        $optCurl[CURLOPT_ENCODING] = 'UTF-8';
        $optCurl[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13';
        $optCurl[CURLOPT_RETURNTRANSFER] = true;
        $optCurl[CURLOPT_TIMEOUT] = 5;
        $optCurl[CURLOPT_SSL_VERIFYHOST] = 0;
        $optCurl[CURLOPT_SSL_VERIFYPEER] = 0;
        $optCurl[CURLOPT_PORT] = $port;

        curl_setopt_array($objCurl, $optCurl);

        $res = curl_exec($objCurl);
        curl_close($objCurl);
        return $res;
    }

    /**
     * 與Linepay溝通
     *
     * @param string $url
     * @param array  $data
     * @param string $method
     * @return void
     */
    public function sendToLinepay($url, $data, $method = 'post')
    {
        $channelId = env('LINEPAY_CHANNEL_ID');
        $channelSecret = env('LINEPAY_CHANNEL_PWD');

        $header = [
            "Content-Type: application/json; charset=UTF-8",
            "X-LINE-ChannelId: $channelId",
            "X-LINE-ChannelSecret: $channelSecret",
            "X-LINE-MerchantDeviceType: N"
        ];

        $objCurl = curl_init($url);

        switch ($method) {
            case 'get':
                curl_setopt($objCurl, CURLOPT_HTTPGET, true);
                break;
            case 'post':
                curl_setopt($objCurl, CURLOPT_POST, true);
                break;
        }

        curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($objCurl, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1');
        curl_setopt($objCurl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($objCurl, CURLOPT_POSTFIELDS, json_encode($data));

        $result = json_decode(curl_exec($objCurl), true);
        curl_close($objCurl);

        return $result;
    }
}
