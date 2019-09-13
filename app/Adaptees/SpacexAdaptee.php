<?php

namespace App\Adaptees;

use App\Builders\DataSourceBuilder;
use App\Adaptees\DataSourceAdaptee;
use App\Builders\SpacexBuilder;

/**
 * SpacexAdaptee retrieves data from the spacex API
 * 
 * @package App\Adaptees
 */
class SpacexAdaptee extends DataSourceAdaptee {

    /**
     * @var $apiBaseUrl
     */
    protected $apiBaseUrl;

    /**
     * @var $apiVersion
     */
    protected $apiVersion;

    /**
     * @var $endpoint
     */
    protected $endpoint;

    /**
     * @var DEFAULT_PARAMS_MAPPING
     */
    protected const DEFAULT_PARAMS_MAPPING = [
        'year' => 'launch_year',
        'limit' => 'limit'
    ];

    public function __construct() {
        $this->apiBaseUrl = 'https://api.spacexdata.com';
        $this->apiVersion = '/v2/';
        $this->endpoint = 'launches';
        parent::__construct();
    }

    /**
     * Spacex API specific retrieve implementation
     * 
     * @param $params Parameters to filter request
     * @return array Array of DataSource objects returned from the Spacex API
     */
    public function get(array $params): array  {
        $fullUrl = $this->apiBaseUrl . $this->apiVersion . $this->endpoint;
        
        if($params) {
            $query = $this->buildQuery($params);
            $fullUrl .= '?' . $query;
        }

        $response = $this->request($fullUrl);

        if ($response) {
            // Build a DataSource object for each response item
            foreach($response as $item) {
                $datasourceBuilder = new DataSourceBuilder();
                $this->data[] = $datasourceBuilder->build(new SpacexBuilder(), $item);
            }
        }
        
        return $this->data;
    }
}
