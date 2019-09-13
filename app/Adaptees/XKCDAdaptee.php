<?php

namespace App\Adaptees;

use App\Builders\DataSourceBuilder;
use App\Adaptees\DataSourceAdaptee;
use App\Builders\XKCDBuilder;

/**
 * XKCDAdaptee retrieves data from the XKCD API
 * 
 * @package App\Adaptees
 */
class XKCDAdaptee extends DataSourceAdaptee {

    /**
     * @var $apiBaseUrl
     */
    protected $apiBaseUrl;

    /**
     * @var $suffix
     */
    protected $suffix;

    /**
     * @var $posts
     */
    protected $posts;

    /**
     * @var DEFAULT_PARAMS_MAPPING
     */
    protected const DEFAULT_PARAMS_MAPPING = [
        'year' => 'year',
        'limit' => 'limit'
    ];

    public function __construct() {
        $this->apiBaseUrl = 'https://xkcd.com/';
        $this->suffix = 'info.0.json';
        parent::__construct();
    }

    /**
     * XKCD API specific retrieve implementation
     * 
     * @param array $params Parameters to filter request
     * @return array Array of DataSource objects returned from the XKCD API
     */
    public function get(array $params): array {        
        $posts = [];

        if($params) {
            // Retireve all the posts based on given parameters
            $posts = $this->findPosts($this->parseQueryParams($params));
        }

        if ($posts) {
            if(!is_array($posts)) {
                // Build single DataSource object
                $datasourceBuilder = new DataSourceBuilder();
                $this->data[] = $datasourceBuilder->build(new XKCDBuilder(), $posts); 
            } else {
                // Build DataSource object for each post
                foreach($posts as $post) {
                    $datasourceBuilder = new DataSourceBuilder();
                    $this->data[] = $datasourceBuilder->build(new XKCDBuilder(), $post);
                }
            }
        }
        
        return $this->data;
    }

    /**
     * Find all the posts based on given parameters
     * 
     * @param array $params Parameters to filter request
     * @return array Posts find based on given parameters
     */
    public function findPosts(array $params): array {
        $posts = [];

        if(array_key_exists('year', $params)) {
            $baseIndex = 1;
            $year = $params['year'];
        
            // Retrieve the first post
            $firstPost = $this->request($this->apiBaseUrl . '/' . $baseIndex . '/' . $this->suffix);

            // Retrieve the last post
            $lastPost = $this->request($this->apiBaseUrl . $this->suffix);

            // Use binarySearch to find all the posts
            $posts = $this->binarySearch($year, $firstPost, $lastPost);
        } else {

            // If there is no year specified return the last post
            $posts = $this->request($this->apiBaseUrl . $this->suffix);
        }

        // Sort the posts ASC
        sort($posts);

        // If there is a limit, than limit the amount of results accordignly
        if (array_key_exists('limit', $params)) {
            $limit = $params['limit'];
            $posts = array_slice($posts, 0, $limit);
        }
        
        return $posts;
    }

    /**
     * Use BinarySearch to find posts in a given year. This method uses recursion.
     * 
     * @param string $year Year to search posts from
     * @param object $firstPost The first post
     * @param object $lastPost The last post
     */
    public function binarySearch(string $year, object $firstPost, object $lastPost): array {

        // Find the median
        $median = floor(($firstPost->num + $lastPost->num) / 2); 

        // Retrieve the post based on the median
        $post = $this->request($this->apiBaseUrl . '/' . $median . '/' . $this->suffix);

        // Check if the year of the median post is equal to the given year
        if($post->year === $year) { 
            $this->posts[] = $post;

            // Check if there are posts from the same year before the found post
            $this->handlePrevPost($post, $year);

            // Check if there are posts from the same year after the found post
            $this->handleNextPost($post, $year);
        }

        // Check if the given year is lower than the year of the median post
        if($year < $post->year) {
            // Binary search the first half of the posts
            $this->binarySearch($year, $firstPost, $post);
        }

        // Check if the given year is higher than the year of the median post
        if($year > $post->year) {
            // Binary search the last half of the posts
            $this->binarySearch($year, $post, $lastPost);
        }

        return $this->posts;
    }

    /**
     * Find posts in the given year after the given post. This method uses recursion.
     * 
     * @param object $post Post to check
     * @param string $year Year to find posts in
     * @return void
     */
    public function handleNextPost(object $post, string $year) {
        $number = $post->num + 1;
        $nextPost = $this->request($this->apiBaseUrl . '/' . $number . '/' . $this->suffix);

        if($year === $nextPost->year) {
            $this->posts[] = $nextPost;
            $this->handleNextPost($nextPost, $year);
        }

        return;
    }

    /**
     * Find posts in the given year before the given post. This method uses recursion.
     * 
     * @param object $post Post to check
     * @param string $year Year to find posts in
     * @return void
     */
    public function handlePrevPost(object $post, string $year) {
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
