<?php

namespace SimpleWechat\Common;

class Tool
{
    static public function https_json($url, $data='', $method='GET')
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0"); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        if($method=='POST'){
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            if ($data != ''){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
            }
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }


    static public function https_get($url,$params)
    {
        $request_string = http_build_query($params);

        $request_url = $url.'?'.$request_string;

        $originalResult = self::https_json($request_url);

        return $originalResult;
    }

    static public function rand_str($randLength = 6, $addtime = 0, $includenumber = 1)
    {
        if ($includenumber) {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        } else {
            $chars = 'abcdefghijklmnopqrstuvwxyz';
        }
        $len = strlen($chars);
        $randStr = '';
        for ($i = 0; $i < $randLength; $i++) {
            $randStr .= $chars[mt_rand(0, $len - 1)];
        }
        $tokenvalue = $randStr;
        if ($addtime) {
            $tokenvalue = $randStr . time();
        }
        return $tokenvalue;
    }


}