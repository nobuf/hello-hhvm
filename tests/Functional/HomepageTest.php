<?hh

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        $response = $this->runAppWithDefaultToken('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('YO!', (string)$response->getBody());
    }

    public function testGetHomepageWithInvalidToken()
    {
        $response = $this->runApp('GET', '/', null, 'invalid-token');
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * Test that the index route with optional name argument returns a rendered greeting
     */
    public function testGetHomepageWithGreeting()
    {
        $response = $this->runAppWithDefaultToken('GET', '/name');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('YO, name!', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runAppWithDefaultToken('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}
