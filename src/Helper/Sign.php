<?php
namespace tinymeng\wemeet\Helper;

class Sign
{
    /**
     * 生成签名
     * @param string $secretId
     * @param string $secretKey
     * @param string $httpMethod
     * @param string $nonce
     * @param string $timestamp
     * @param string $uri
     * @param string $body
     * @return string
     */
    public static function make($secretId, $secretKey, $httpMethod, $nonce, $timestamp, $uri, $body = '')
    {
        $toSign = sprintf(
            "%s\nX-TC-Key=%s&X-TC-Nonce=%s&X-TC-Timestamp=%s\n%s\n%s",
            $httpMethod,
            $secretId,
            $nonce,
            $timestamp,
            $uri,
            $body
        );
        $hash = hash_hmac('sha256', $toSign, $secretKey, true);
        $hex = strtolower(bin2hex($hash));
        return base64_encode($hex);
    }
}
