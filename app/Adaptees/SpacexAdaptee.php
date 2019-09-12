<?php

namespace App\Adaptees;

use App\Builders\DataSourceBuilder;
use App\Adaptees\DataSourceAdaptee;
use App\Builders\SpacexBuilder;

class SpacexAdaptee extends DataSourceAdaptee {

    protected $apiBaseUrl;
    protected $apiVersion;
    protected $endpoint;
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

    public function get(array $params)  {
        $fullUrl = $this->apiBaseUrl . $this->apiVersion . $this->endpoint;
        
        if($params) {
            $query = $this->buildQuery($params);
            $fullUrl .= '?' . $query;
        }

        $response = $this->request($fullUrl);

        if ($response) {
            foreach($response as $item) {
                $datasourceBuilder = new DataSourceBuilder();
                $this->data[] = $datasourceBuilder->build(new SpacexBuilder(), $item);
            }
        }
        
        return $this->data;
    }
}
