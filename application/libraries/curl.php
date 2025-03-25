<?php
defined('BASEPATH') or exit('No direct script access allowed');

class curl
{

    private $ch;

    public function __construct()
    {
        // Initialize cURL session
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function setUrl($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }

    public function setHeaders($headers = [])
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    }

    public function setPostFields($data)
    {
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    public function execute()
    {
        $response = curl_exec($this->ch);
        $http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $http_time = curl_getinfo($this->ch, CURLINFO_TOTAL_TIME);
        return ['response' => $response, 'http_code' => $http_code, 'http_time' => $http_time];
    }

    public function close()
    {
        curl_close($this->ch);
    }
}
