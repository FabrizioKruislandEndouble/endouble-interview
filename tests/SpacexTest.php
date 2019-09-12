<?php

class SpacexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostNumber()
    {
        $this->get('api/data?sourceId=spacex&year=2013&limit=1');

        $response = json_decode($this->response->getContent());

        $this->assertEquals(
            10, $response->data[0]->number
        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLimit()
    {
        $this->get('api/data?sourceId=spacex&limit=2');

        $response = json_decode($this->response->getContent());

        $this->assertEquals(
            2, count($response->data)
        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testYear()
    {
        $this->get('api/data?sourceId=spacex&year=2007&limit=1');

        $response = json_decode($this->response->getContent());

        $this->assertEquals(
            2007, date('Y', strtotime($response->data[0]->date))
        );
    }
}
