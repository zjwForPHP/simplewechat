<?php

namespace SimpleWechat\Init;

class InitApplication{

    protected $appid;
    protected $secret;

    public function __construct($config)
    {
        $require = ['app_id','secret'];

        self::IsEmpty($config,$require);

        $this->appid = $config['app_id'];
        $this->secret = $config['secret'];

    }

    /**
     * 判断入参是否为空，并报错
     * @param $data
     * @param $key
     */
    static protected function IsEmpty($data,$key)
    {
        if(!is_array($key))
        {
            if(empty($data[$key])||!isset($data[$key]))
            {

                throw new \Exception($key.'---参数不能为空',1001);

            }
        }else{
            $warning_string = '';
            foreach ($key as $k=>$value)
            {
                if(empty($data[$value])||!isset($data[$value]))
                {
                    $warning_string .= $key[$k]."---参数不能为空   ";
                }
            }

            if($warning_string != '')
            {

                throw new \Exception($warning_string,1001);
            }

        }

    }
}