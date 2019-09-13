<?php

namespace App\Builders;

use App\DataSource;
use App\Interfaces\DataSourceBuilderInterface;
use Carbon\Carbon;

/**
 * Build DataSource object based on XKCD API data
 * 
 * @package App\Builders
 */
class XKCDBuilder implements DataSourceBuilderInterface {

    /**
     * @var $datasource
     */
    protected $datasource;

    public function __construct() {
        $this->datasource = new DataSource();
    }

    /**
     * Map XKCD API data to DataSource object
     * 
     * @param $data Data to map to DataSource object
     * @return \App\DataSource
     */
    public function map($data): \App\DataSource {
        $this->datasource->setNumber($data->num);
        $this->datasource->setDate($this->buildDate($data->year, $data->month, $data->day));
        $this->datasource->setName($data->safe_title);
        $this->datasource->setLink($data->link);
        $this->datasource->setDetails($data->transcript);

        return $this->datasource;
    }

    /**
     * Build date object from year, month, date
     * 
     * @param string $year Year
     * @param string $month Month
     * @param string $day Day
     * @return string Formatted Date
     */
    public function buildDate(string $year, string $month, string $day): string {
        return Carbon::createFromDate($year,$month, $day)->format('Y-m-d');
    }
}