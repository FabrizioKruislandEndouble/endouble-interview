<?php

namespace App\Adaptees;

use App\Builders\DataSourceBuilder;
use App\Adaptees\DataSourceAdaptee;
use App\Builders\XKCDBuilder;

class XKCDAdaptee extends DataSourceAdaptee {

    protected $apiBaseUrl;
    protected $suffix;
    protected $posts;
    protected const DEFAULT_PARAMS_MAPPING = [
        'year' => 'year',
        'limit' => 'limit'
    ];

    public function __construct() {
        $this->apiBaseUrl = 'https://xkcd.com/';
        $this->suffix = 'info.0.json';
        parent::__construct();
    }

    public function get(array $params) {        
        $posts = [];

        if($params) {
            $posts = $this->findPosts($this->parseQueryParams($params));
        }

        if ($posts) {
            if(!is_array($posts)) {
                $datasourceBuilder = new DataSourceBuilder();
                $this->data[] = $datasourceBuilder->build(new XKCDBuilder(), $posts); 
            } else {
                foreach($posts as $post) {
                    $datasourceBuilder = new DataSourceBuilder();
                    $this->data[] = $datasourceBuilder->build(new XKCDBuilder(), $post);
                }
            }
        }
        
        return $this->data;
    }

    public function findPosts(array $params) {
        $posts = [];

        if(array_key_exists('year', $params)) {
            $baseIndex = 1;
            $year = $params['year'];
        
            $firstPost = $this->request($this->apiBaseUrl . '/' . $baseIndex . '/' . $this->suffix);
            $lastPost = $this->request($this->apiBaseUrl . $this->suffix);

            $posts = $this->binarySearch($year, $firstPost, $lastPost);
        } else {
            $posts = $this->request($this->apiBaseUrl . $this->suffix);
        }

        sort($posts);

        if (array_key_exists('limit', $params)) {
            $limit = $params['limit'];
            $posts = array_slice($posts, 0, $limit);
        }
        
        return $posts;
    }

    public function binarySearch($year, $firstPost, $lastPost) {

        $median = floor(($firstPost->num + $lastPost->num) / 2); 

        $post = $this->request($this->apiBaseUrl . '/' . $median . '/' . $this->suffix);

        if($post->year === $year) { 
            $this->posts[] = $post;
            $this->handlePrevPost($post, $year);
            $this->handleNextPost($post, $year);
        }

        if($year < $post->year) {
            $this->binarySearch($year, $firstPost, $post);
        }

        if($year > $post->year) {
            $this->binarySearch($year, $post, $lastPost);
        }

        return $this->posts;
    }

    public function handleNextPost($post, $year) {
        $number = $post->num + 1;
        $nextPost = $this->request($this->apiBaseUrl . '/' . $number . '/' . $this->suffix);

        if($year === $nextPost->year) {
            $this->posts[] = $nextPost;
            $this->handleNextPost($nextPost, $year);
        }

        return;
    }

    public function handlePrevPost($post, $year) {
        $number = $post->num - 1;

        if (!$number <= 0) {
            $prevPost = $this->request($this->apiBaseUrl . '/' . $number . '/' . $this->suffix);

            if($year === $prevPost->year) {
                $this->posts[] = $prevPost;
                $this->handlePrevPost($prevPost, $year);
            }
        }

        return;
    }
}
