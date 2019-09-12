<?php

namespace App\Builders;

use App\DataSource;
use App\Interfaces\DataSourceBuilderInterface;
use Carbon\Carbon;

class XKCDBuilder implements DataSourceBuilderInterface {

    protected $datasource;

    public function __construct() {
        $this->datasource = new DataSource();
    }

    public function map($data) {
        $this->datasource->setNumber($data->num);
        $this->datasource->setDate($this->buildDate($data->year, $data->month, $data->day));
        $this->datasource->setName($data->safe_title);
        $this->datasource->setLink($data->link);
        $this->datasource->setDetails($data->transcript);

        return $this->datasource;
    }

    public function buildDate(string $year, string $month, string $day) {
        return Carbon::createFromDate($year,$month, $day)->format('Y-m-d');
    }
}