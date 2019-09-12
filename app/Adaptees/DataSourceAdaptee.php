<?php 

namespace App\Adaptees; 

use \GuzzleHttp\Client;

abstract class DataSourceAdaptee {

    protected $data;
    protected $client;
    protected const DEFAULT_PARAMS_MAPPING = [
        'limit' => 'limit'
    ];

    public function __construct() {
        $this->client = new Client();
    }

    public function get(array $params) {
        return $this->data;
    }

    public function request($fullUrl) {
        return json_decode($this->client->get($fullUrl)->getBody()->getContents());
    }

    public function buildQuery(array $params): string {
        return http_build_query($this->parseQueryParams($params));
    }

    public function parseQueryParams(array $params): array{

        $parsedQueryParams = [];
        
        foreach(static::DEFAULT_PARAMS_MAPPING as $originalParam => $newParam) {
            if(array_key_exists($originalParam, $params)) {
                $parsedQueryParams[$newParam] = $params[$originalParam];
            }
        }

        return $parsedQueryParams;
    }

}
