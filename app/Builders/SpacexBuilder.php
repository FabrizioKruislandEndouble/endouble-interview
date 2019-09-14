<?php

namespace App\Builders;

use App\DataSource;
use App\Interfaces\DataSourceBuilderInterface;
use Carbon\Carbon;

/**
 * Build DataSource object based on spacex API data
 * 
 * @package App\Builders
 */
class SpacexBuilder implements DataSourceBuilderInterface {

    /**
     * @var $datasource
     */
    protected $datasource;

    public function __construct() {
        $this->datasource = new DataSource();
    }

    /**
     * Map spacex API data to DataSource object
     * 
     * @param $data Data to map to DataSource object
     * @return \App\DataSource
     */
    public function map($data): \App\DataSource {
        $this->datasource->number = $data->flight_number;
        $this->datasource->date = $this->formatDate($data->launch_date_utc);
        $this->datasource->name = $data->mission_name;
        $this->datasource->link = $data->links->article_link;
        $this->datasource->details = $data->details;

        return $this->datasource;
    }

    /**
     * Format date object from utc date to Y-m-d
     * 
     * @param string $date Date to format
     * @return string Formatted Date
     */
    public function formatDate(string $date): string {
        return date("Y-m-d", strtotime($date));
    }
}