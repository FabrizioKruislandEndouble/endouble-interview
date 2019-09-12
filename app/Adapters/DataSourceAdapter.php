<?php

namespace App\Adapters;

use App\Adaptees\DataSourceAdaptee;
use App\Interfaces\DataSourceInterface;
use App\Http\Resources\DataSource;

class DataSourceAdapter implements DataSourceInterface
{
    public $dataSourceAdaptee;

    public function __construct(DataSourceAdaptee $adaptee)
    {
        $this->dataSourceAdaptee = $adaptee;
    }

    public function get(array $params): array
    {
        return DataSource::make(['params'=> $params ,'data' => $this->dataSourceAdaptee->get($params)])->resolve();
    }
}