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

class PemilikTest extends GuzzleTestCase
{
    protected $_client;
    protected $url = 'http://localhost/apotekkppl/backend/user/';
    protected $token;
    protected $id = 'rama5';

    public function setUp()
    {
        $this->_client = new ServiceClient();
        $this->token = "";
    }

    public function testPemilikLogin()
    {
        // The following request will get the mock response from the plugin in FIFO order
        $data = [
            'username' => $this->id,
            'password' => $this->id
        ];
        $request = $this->_client->post($this->url.'login', array(), array('input'=>$data));
        $request->getQuery()->set('view', 'recent_open_or_overdue');
        $response = $request->send();
        $body = $response->json();

        $this->token = 'Bearer '.$body['data']['token'];
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($body['status']);
        $this->assertNotNull($body['data']['token']);
        $data = [
            'token' => $this->token
        ];
        return $data;
    }

    /**
     * @depends testPemilikLogin
     */

     public function testGetLaporanPenjualanList($data){
         $request = $this->_client->get($this->url.'pemilik/laporan_ro?username='.$this->id);
         $request->addHeader('authorization', $data['token']);
         $response = $request->send();
         $body = $response->json();
         $this->assertEquals(200,$response->getStatusCode());
         $this->assertNotNull($body);

         return $data;
     }

     /**
      * @depends testGetLaporanPenjualanList
      */

     public function testGetLaporanPembelianList($data){
         $request = $this->_client->get($this->url.'pemilik/laporan_po?username='.$this->id);
         $request->addHeader('authorization', $data['token']);
         $response = $request->send();
         $body = $response->json();
         $this->assertEquals(200,$response->getStatusCode());
         $this->assertNotNull($body);

         return $data;
     }

     /**
      * @depends testPemilikLogin
      */

     public function testAccessApotekerForbidden($token){

         $request = $this->_client->get($this->url.'apoteker?username='.$this->id);
         $request->addHeader('authorization', $token['token']);
         $response = $request->send();
         $body = $response->json();

         $this->assertEquals(200, $response->getStatusCode());
         $this->assertFalse($body['status']);
         $this->assertNotNull($body);
     }

     /**
      * @depends testPemilikLogin
      */

     public function testAccessKasirForbidden($token){

         $request = $this->_client->get($this->url.'kasir?username='.$this->id);
         $request->addHeader('authorization', $token['token']);
         $response = $request->send();
         $body = $response->json();

         $this->assertEquals(200, $response->getStatusCode());
         $this->assertFalse($body['status']);
         $this->assertNotNull($body);
     }

     /**
      * @depends testPemilikLogin
      */

     public function testAccessPengadaanForbidden($token){

         $request = $this->_client->get($this->url.'pengadaan?username='.$this->id);
         $request->addHeader('authorization', $token['token']);
         $response = $request->send();
         $body = $response->json();

         $this->assertEquals(200, $response->getStatusCode());
         $this->assertFalse($body['status']);
         $this->assertNotNull($body);
     }

     /**
      * @depends testPemilikLogin
      */

     public function testAccessAdminForbidden($token){

         $request = $this->_client->get($this->url.'admin?username='.$this->id);
         $request->addHeader('authorization', $token['token']);
         $response = $request->send();
         $body = $response->json();

         $this->assertEquals(200, $response->getStatusCode());
         $this->assertFalse($body['status']);
         $this->assertNotNull($body);
     }

     public function testLogoutRequests()
     {
         // The following request will get the mock response from the plugin in FIFO order
         $data = [
             'username' => $this->id
         ];
         $request = $this->_client->post($this->url.'logout');
         $response = $request->send();
         $body = $response->json();

         $this->assertEquals(200, $response->getStatusCode());
         $this->assertTrue($body['status']);
         return $this->token;
     }
}
