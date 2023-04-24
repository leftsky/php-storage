<?php

namespace Leftsky\Storage\ways;

use OSS\Core\OssException;
use OSS\OssClient;

class Alioss extends Base
{
    private $config = [
        // 文件夹
        "folder" => "",
        // 超时时间
        'expire' => "",
        // OSS 域名
        'domain' => "",
        // 最大大小
        'maxsize' => "",
        // 密钥 Id
        'accessKeyId' => "",
        // 密钥 Secret
        'accessKeySecret' => "",
        // bucket 地域
        'region' => "",
        // bucket 名
        'bucket' => ""
    ];

    /**
     * 初始化，并设置配置
     * @param array|null $config
     */
    public function __construct(array $config = null)
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * 请在 app.php 中添加如下配置
     * @return OssClient|null
     */
    private function getOssHandle(): ?OssClient
    {
        try {
            return new OssClient($this->config['accessKeyId'],
                $this->config['accessKeySecret'], $this->config['region']);
        } catch (OssException $e) {
            return null;
        }
    }

    /**
     * 【Laravel 请求专属】自动检测 request 中单个file文件，上传至oss并返回路径
     * @param $file
     * @return string
     */
    public function ossUpload($file): string
    {
        return $this->uploadFromPath($file->path(), $file->getClientOriginalExtension());
    }

    /**
     * 从 path 上传至 oss
     * @param string $path 文件路径
     * @param string $extension 文件后缀
     */
    public function uploadFromPath(string $path, string $extension): string
    {
        $rand = rand(100000, 999999);
        $now = date("Y-m-d_H_i_s_", time());
        $uri = $this->config["folder"] . $now . $rand . "." . $extension;
        $ossClient = $this->getOssHandle();
        $ossClient->uploadFile($this->config['bucket'], $uri, $path);
//        $ossClient->putObject($this->config['bucket'], $uri, file_get_contents($path));
        return "{$this->config["domain"]}/$uri";
    }

}