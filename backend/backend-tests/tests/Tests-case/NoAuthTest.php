<?php
/**
 * Simple test class for showing how to test with Guzzle
 */

namespace Testcase;

use Guzzle\Tests\GuzzleTestCase,
    Guzzle\Plugin\Mock\MockPlugin,
    Guzzle\Http\Message\Response,
    Guzzle\Http\Client as HttpClient,
    Guzzle\Service\Client as ServiceClient,
    Guzzle\Http\EntityBody;

class NoAuthTest extends GuzzleTestCase
{
    protected $_client;
    protected $url = 'http://localhost/APOTEK-KPPL/backend/user/';
    protected $token;
    protected $id = 'rama';

    public function setUp()
    {
        $this->_client = new ServiceClient();
        $this->token = "";
    }

    public function testFalseLogin()
    {
        // The following request will get the mock response from the plugin in FIFO order
        $data = [
            'username' => 'LOWL',
            'password' => $this->id
        ];
        $request = $this->_client->post($this->url.'login', array(), array('input'=>$data));
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
    }

    /**
     * @depends testFalseLogin
     */

    public function testAccessAdminForbidden(){

        $request = $this->_client->get($this->url.'admin');
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testFalseLogin
     */

    public function testAccessApotekerForbidden(){

        $request = $this->_client->get($this->url.'apoteker');
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testFalseLogin
     */

    public function testAccessKasirForbidden(){

        $request = $this->_client->get($this->url.'kasir');
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testFalseLogin
     */

    public function testAccessPengadaanForbidden(){

        $request = $this->_client->get($this->url.'pengadaan');
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testFalseLogin
     */

    public function testAccessPemilikForbidden(){

        $request = $this->_client->get($this->url.'pemilik');
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }


}
