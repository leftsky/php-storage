<?php

namespace Leftsky\Storage\ways;

use GuzzleHttp\Client;
use OpenAPI\Client\Api\AuthApi;
use OpenAPI\Client\Api\FileinfoApi;
use OpenAPI\Client\Api\FileuploadApi;
use OpenAPI\Client\Api\MultimediafileApi;
use OpenAPI\Client\Api\UserinfoApi;

class BaiduWangPan extends Base
{
    // 授权 和 accessToken 回调地址
    private string $cb_url = '';
    // 百度网盘提供的三个密钥
    // client_id
    private string $AppKey = "";
    // client_secret
    private string $SecretKey = "";
    private string $SignKey = "";
    // accessToken
    private string $token = "";
    // 基础目录
    private string $base_dir = "";

    public function __construct($config)
    {
        $this->cb_url = $config["cb_url"];
        $this->AppKey = $config["AppKey"];
        $this->SecretKey = $config["SecretKey"];
        $this->SignKey = $config["SignKey"];
        $this->base_dir = $config["base_dir"];
    }

    public function getOathUrl(): string
    {
        return "http://openapi.baidu.com/oauth/2.0/authorize?"
            . "response_type=code&client_id={$this->AppKey}&redirect_uri="
            . "{$this->cb_url}&scope=basic,netdisk";
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * 使用code获得token
     * @param $code
     */
    public function codeGetToken($code)
    {
        $apiInstance = new AuthApi(new Client());

        try {
            $result = $apiInstance->oauthTokenCode2token($code, $this->AppKey, $this->SecretKey, $this->cb_url);
//            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling AuthApi->oauthTokenCode2token: ', $e->getMessage(), PHP_EOL;
            return false;
        }
        return $result;
    }


    public function quota()
    {
        $access_token = $this->token;
        $checkexpire = 1;      // int |  (optional)
        $checkfree = 1;        // int |  (optional)


        $apiInstance = new UserinfoApi(new Client());

        try {
            $result = $apiInstance->apiquota($access_token, $checkexpire, $checkfree);
//            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling UserinfoApi->apiquota: ', $e->getMessage(), PHP_EOL;
        }
    }


    public function userInfo()
    {
        $access_token = $this->token;

        $apiInstance = new UserinfoApi(new Client());

        try {
            $result = $apiInstance->xpannasuinfo($access_token);
//            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling UserinfoApi->xpannasuinfo: ', $e->getMessage(), PHP_EOL;
        }
    }

    private function filePreCreate($path, $size, $block_list)
    {
        $access_token = $this->token;
        $path = urlencode($this->base_dir . $path);
        $isdir = 0;
        $autoinit = 1;
        $rtype = 3;

        $apiInstance = new FileuploadApi(new Client());

        try {
            $result = $apiInstance->xpanfileprecreate($access_token,
                $path, $isdir, $size, $autoinit, $block_list, $rtype);
//            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling filePreCreate: ', $e->getMessage(), PHP_EOL;
            return false;
        }

        return $result;
    }

    private function pssuperFile($uplodidTmp, $path, $partseq, $file)
    {
        $access_token = $this->token;
        $path = urlencode($this->base_dir . $path);
        $uploadid = $uplodidTmp;
        $type = "tmpfile";

        $apiInstance = new FileuploadApi(new Client());

        try {
            $result = $apiInstance->pcssuperfile2($access_token,
                $partseq, $path, $uploadid, $type, $file);
//            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling FileuploadApi->pcssuperfile2: ', $e->getMessage(), PHP_EOL;
        }
    }

    private function fileUploadFinish($uplodidTmp, $path, $size, $block_list)
    {
        $access_token = $this->token;
        $path = $this->base_dir . $path;
        $isdir = 0;
        $uploadid = $uplodidTmp;
        $rtype = 3;

        $apiInstance = new FileuploadApi(new Client());

        try {
            $result = $apiInstance->xpanfilecreate($access_token,
                $path, $isdir, $size, $uploadid, $block_list, $rtype);
//            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling fileUploadFinish: ', $e->getMessage(), PHP_EOL;
        }
    }

    /**
     * @param string $filePath 需要上传的文件路径
     * @param string $storage_name 保存的文件名
     * @return int 0 上传成功 -1 文件不存在 -2 预上传失败
     */
    public function fileupload(string $filePath, string $storage_name): int
    {
        if (!file_exists($filePath)) return -1;

        $size = filesize($filePath);
        $every_part_size = 4096 * 1024;
        $total_block = ceil($size / $every_part_size);

        $block_md5_list = [];

        $file = fopen($filePath, "rb");
        while ($total_block > 0) {
            $block_md5_list [] = md5(fread($file, $every_part_size));
            $total_block--;
        }
        fclose($file);

        $block_md5_list = "[\"" . implode("\",\"", $block_md5_list) . "\"]";

        // precreate
        $precreateReturn = $this->filePreCreate($storage_name, $size, $block_md5_list);
        if ($precreateReturn->getErrno() != 0) {
//            echo 'Exception when calling fileupload: errno:', $precreateReturn->getErrno(), PHP_EOL;
            return -2;
        }

        // superfile2
        $total_block = ceil($size / $every_part_size);
        $seq = 0;
        $tempPath = "";
        $file = fopen($filePath, "rb");
        while ($seq < $total_block) {
//            echo "上传文件$seq\n";
            $tempPath = __DIR__ . "/$storage_name.tmp";
            file_put_contents($tempPath, fread($file, $every_part_size));
            $this->pssuperFile($precreateReturn->getUploadid(),
                $storage_name, $seq . "", $tempPath);
            $seq++;
        }
        fclose($file);
        unlink($tempPath);

        // create
//        echo "结束上传文件\n";
        $this->fileUploadFinish($precreateReturn->getUploadid(),
            $storage_name, $size, $block_md5_list);
        return 0;
    }

    private function getFileMetas($fids)
    {
        $access_token = $this->token;
        $thumb = "0";                 // string |  (optional)
        $extra = "0";                 // string |  (optional)
        $fsids = "[" . implode(",", $fids) . "]"; // string
        $dlink = "1";                 // string |  (optional)
        $needmedia = 1; // int

        $apiInstance = new MultimediafileApi(new Client());

        try {
            return $apiInstance->xpanmultimediafilemetas($access_token, $fsids, $thumb, $extra, $dlink, "", $needmedia);
        } catch (\Exception $e) {
//            echo 'Exception when calling MultimediafileApi->xpanmultimediafilemetas: ', $e->getMessage(), PHP_EOL;
        }
        return null;
    }

    /**
     * 查询文件是否存在
     * @param $path
     * @return bool
     */
    public function getFileInfo($path): bool
    {
        $access_token = $this->token;
        $dirs = explode("/", $path);
        $file_name = array_pop($dirs);


        // 是否返回缩略图
        $web = "0";
        // 每页大小
        $num = "1";
        // 页码
        $page = "1";
        // 检索目录
        $dir = implode("/", $dirs);
        // 递归子目录
        $recursion = "0";
        $key = $file_name;

        $apiInstance = new FileinfoApi(new Client());

        try {
            $result = $apiInstance->xpanfilesearch($access_token, $key, $web, $num, $page, $dir, $recursion);
            $fids = array_map(function ($item) {
                return $item["fs_id"];
            }, $result["list"] ?? []);
            return $this->getFileMetas($fids);
            //            return $this->getFileMetas();
            //            print_r($result);
        } catch (\Exception $e) {
            return false;
//            echo 'Exception when calling FileinfoApi->xpanfilesearch: ', $e->getMessage(), PHP_EOL;
        }
    }

}
