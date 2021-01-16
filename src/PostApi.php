<?php

namespace Vasyldorosh\PbnSatellite;

use Exception;

class PostApi
{
    const URL = 'http://pbn-platform.loc/api';

    /**
     * @param string $domain
     * @return array
     */
    public function getPosts(string $domain): array
    {
        return $this->sendRequest('/posts/', 'GET', [], compact('domain'));
    }

    /**
     * @param string $domain
     * @param string $alias
     * @return array
     */
    public function getPost(string $domain, string $alias): array
    {
        return $this->sendRequest('/posts/' . $alias . '/', 'GET', [], compact('domain'));
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array $params
     * @param array $headers
     * @return array
     */
    public function sendRequest(string $uri, string $method, array $params = [], array $headers = []): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::URL . $uri);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 100,
        ]);

        $headersString = [];
        foreach ($headers as $k => $v) {
            $headersString[] = "$k: $v";
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headersString);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close ($ch);

        if ($info['http_code'] !== 200) {
            return [];
        }

        return json_decode($result, true);
    }
}