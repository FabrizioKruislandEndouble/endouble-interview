<?php

namespace App\Adapters;

use App\Adaptees\DataSourceAdaptee;
use App\Interfaces\DataSourceInterface;
use App\Http\Resources\DataSource;

/**
 * DataSourceAdapter converts the interfaces of different datasources to a DataSource object
 * 
 * @package App\Adapters
 */
class DataSourceAdapter implements DataSourceInterface
{
    /**
     * @var $dataSourceAdaptee
     */
    public $dataSourceAdaptee;

    public function __construct(DataSourceAdaptee $adaptee)
    {
        $this->dataSourceAdaptee = $adaptee;
    }

    /**
     * Retrieve the formatted data from a datasource
     * 
     * @param string $datasource Datasource key
     * @param array $params Parameters to filter request
     * @return array Formatted data from datasource
     */
    public function get(string $datasource, array $params): array
    {
        return DataSource::make(['datasource' => $datasource, 'params'=> $params ,'data' => $this->dataSourceAdaptee->get($params)])->resolve();
    }
}