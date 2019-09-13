<?php

/**
 * Spacex Test
 */
class SpacexTest extends TestCase
{
    /**
     * Test post number returned for specific year and limit
     *
     * @return void
     */
    public function testPostNumber()
    {
        $this->get('api/spacex?year=2013&limit=1');

        $response = json_decode($this->response->getContent());

        $this->assertEquals(
            10, $response->data[0]->number
        );
    }

    /**
     * Test limit on posts
     *
     * @return void
     */
    public function testLimit()
    {
        $this->get('api/spacex?limit=2');

        $response = json_decode($this->response->getContent());

        $this->assertEquals(
            2, count($response->data)
        );
    }

    /**
     * Test year on posts
     *
     * @return void
     */
    public function testYear()
    {
        $this->get('api/spacex?year=2007&limit=1');

        $response = json_decode($this->response->getContent());

        $this->assertEquals(
            2007, date('Y', strtotime($response->data[0]->date))
        );
    }
}
