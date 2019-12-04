<?php declare(strict_types = 1);

namespace App\Client;

class KebaberClient
{
    private $baseUrl;

    private $port;

    /**
     * @param string $baseUrl
     * @param int $port
     */
    public function __construct(string $baseUrl, int $port)
    {
        $this->baseUrl = $baseUrl;
        $this->port = $port;
    }

    public function getMeat(): array
    {
        return $this->requestGet('/meats');
    }

    /**
     * @param string $endPoint
     *
     * @return array
     */
    protected function requestGet(string $endPoint): array
    {
        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, $this->baseUrl . $endPoint);
        curl_setopt($cUrl, CURLOPT_PORT, $this->port);
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($cUrl);

        return json_decode($json, true);
    }
}
