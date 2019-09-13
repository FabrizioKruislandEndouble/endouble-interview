<?php

namespace App;

/**
 * DataSource
 * 
 * @package App
 */
class DataSource {

    /**
     * @var $number
     */
    public $number;

    /**
     * @var $date
     */
    public $date;

    /**
     * @var $name
     */
    public $name;

    /**
     * @var $link
     */
    public $link;

    /**
     * @var $details
     */
    public $details;

    public function __construct() {
    }

    /**
     * Retrieve datasource number
     * 
     * @return int DataSource number
     */
    public function getNumber(): int {
        return $this->number;
    }

    /**
     * Set datasource number
     * 
     * @param int DataSource number
     */
    public function setNumber(int $number) {
        $this->number = $number;
    }

    /**
     * Retrieve datasource date
     * 
     * @return string DataSource date
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * Set datasource date
     * 
     * @param string DataSource date
     */
    public function setDate(string $date) {
        $this->date = $date;
    }

    /**
     * Retrieve datasource name
     * 
     * @return string DataSource name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set datasource name
     * 
     * @param string DataSource name
     */    
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * Retrieve datasource link
     * 
     * @return string DataSource link
     */    
    public function getLink(): string {
        return $this->link;
    }

    /**
     * Set datasource link
     * 
     * @param string DataSource link
     */        
    public function setLink(?string $link) {
        $this->link = $link;
    }

    /**
     * Retrieve datasource details
     * 
     * @return string DataSource details
     */    
    public function getDetails(): string {
        return $this->details;
    }

    /**
     * Set datasource details
     * 
     * @param string DataSource details
     */        
    public function setDetails(?string $details) {
        $this->details = $details;
    }

}
