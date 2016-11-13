<?php

namespace Tests\Integration;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        $response = $this->request('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello World!', (string)$response->getBody());
    }
}