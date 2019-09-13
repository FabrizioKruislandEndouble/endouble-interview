<?php 

namespace App\Adaptees; 

use \GuzzleHttp\Client;

/**
 * DataSourceAdaptee is used as an template for the implementation of datasource Adaptees
 * 
 * @package App\Adaptees
 */
abstract class DataSourceAdaptee {

    /**
     * @var $data
     */
    protected $data;

    /**
     * @var $client
     */
    protected $client;

    /**
     * @var DEFAULT_PARAMS_MAPPING
     */
    protected const DEFAULT_PARAMS_MAPPING = [
        'limit' => 'limit'
    ];

    public function __construct() {
        $this->client = new Client();
    }

    /**
     * Abstract method which get overriden by datasource adaptee to retrieve datasource data
     * 
     * @param $params Parameters to filter request
     * @return array Data from datasource
     */
    public abstract function get(array $params): array;

    /**
     * Handle request to the datasource endpoint
     * 
     * @param string $fullUrl The url to call
     * @return array|stdClass JSON Decoded data obtained from datasource
     */
    public function request(string $fullUrl) {
        return json_decode($this->client->get($fullUrl)->getBody()->getContents());
    }

    /**
     * Build querystring from parameters given
     * 
     * @param $params Parameters to filter request
     * @return string Querystring to filter request
     */
    public function buildQuery(array $params): string {
        return http_build_query($this->parseQueryParams($params));
    }

    /**
     * Parse given query params to the accepted query params
     * 
     * @param $params Parameters to filter request
     * @return array Parameters which are allowed by datasource
     */
    public function parseQueryParams(array $params): array{
        $parsedQueryParams = [];
        
        // Map the given query params to datasource specific query params
        foreach(static::DEFAULT_PARAMS_MAPPING as $originalParam => $newParam) {
            if(array_key_exists($originalParam, $params)) {
                $parsedQueryParams[$newParam] = $params[$originalParam];
            }
        }

        return $parsedQueryParams;
    }

}
