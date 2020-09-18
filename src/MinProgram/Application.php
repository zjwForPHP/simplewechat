<?php

namespace SimpleWechat\MinProgram;

use SimpleWechat\Init\InitApplication;
use SimpleWechat\Common\Tool;

class Application  extends InitApplication
{

    protected $baseUrl = 'https://api.weixin.qq.com/';

    public function  __construct($config)
    {
        parent::__construct($config);
    }


    public function auth_login($js_code)
    {
        // build request url

        $request_array = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'js_code' => $js_code,
            'grant_type' => 'authorization_code',

        ];

        $request_url = $this->baseUrl.'sns/jscode2session';

        // request

        $originalResult = Tool::https_get($request_url,$request_array);

        $result = json_decode($originalResult,true);

        return $result;
    }


}