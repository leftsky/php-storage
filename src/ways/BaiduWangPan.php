<?php

namespace Leftsky\Storage\ways;

class BaiduWangPan extends Base
{

    // 授权回调地址
    private string $reurl = "";
    // 百度网盘提供的三个密钥
    private string $AppKey = "";
    private string $SecretKey = "";
    private string $SignKey = "";

    public function getOathUrl(): string
    {
        return "http://openapi.baidu.com/oauth/2.0/authorize?"
            . "response_type=code&client_id={$this->AppKey}&redirect_uri="
            . "{$this->reurl}&scope=basic,netdisk";
    }

}