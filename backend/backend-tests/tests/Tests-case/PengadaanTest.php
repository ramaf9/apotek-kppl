<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

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

class PengadaanTest extends GuzzleTestCase
{
    protected $_client;
    protected $url = 'http://localhost/APOTEK-KPPL/backend/user/';
    protected $token;
    protected $id = 'rama3';

    public function setUp()
    {
        $this->_client = new ServiceClient();
        $this->token = "";
        // $this->setMockBasePath('./mock/responses');
        // $this->setMockResponse($this->_client, array('response1'));
        //
        // $this->getServer()->enqueue(array());
    }

    public function testLoginRequests()
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
        // $header = $response->getHeaders();
        // $body = $response->getBody();
        // echo json_encode($response);
        $this->token = 'Bearer '.$body['data']['token'];
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($body['status']);
        $this->assertNotNull($body['data']['token']);
        return $this->token;
    }

    /**
     * @depends testLoginRequests
     */

    public function testCreateObatPanadol($token){
        $input = array(
            'name' => 'Panadol',
    		'price' => '3000',
    		'unit' => 'BOTOL',
    		'quantity' => 100
        );
        $request = $this->_client->post($this->url.'pengadaan/obat?username='.$this->id, array(), $input);
        $request->addHeader('authorization', $token);
        $response = $request->send();
        $body = $response->json();
        $this->assertEquals(201,$response->getStatusCode());
        $this->assertNotNull($body);
        $data = [
            'token' => $token
        ];
        return $data;
    }

    /**
     * @depends testCreateObatPanadol
     */

    public function testGetObatList($data){
        $request = $this->_client->get($this->url.'pengadaan/obat?username='.$this->id);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotNull($body);
        $countuser = count($body);
        $data['id'] = $body[$countuser-1]['o_id'];

        return $data;
    }

    /**
     * @depends testGetObatList
     */

    public function testUpdatePanadolStock($data){
        $input = array(
            'obat' => $data['id'],
    		'quantity' => 10,
    		'vendor' => 'Anon',
        );
        $request = $this->_client->post($this->url.'pengadaan/pengadaan_obat?username='.$this->id, array(), $input);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertTrue($body['status']);
        $this->assertEquals(201,$response->getStatusCode());

        return $data;
    }

    /**
     * @depends testUpdatePanadolStock
     */

    public function testGetPengadaanObat($data){
        $request = $this->_client->get($this->url.'pengadaan/pengadaan_obat?username='.$this->id);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotNull($body);
        $countuser = count($body);
        $data['id'] = $body[$countuser-1]['o_id'];
        $data['pid'] = $body[$countuser-1]['po_id'];
        $data['quantity'] = $body[$countuser-1]['po_quantity'];

        return $data;
    }

    /**
     * @depends testGetPengadaanObat
     */

    public function testConfirmUpdatePanadolStock($data){
        $input = array(
            'o_id' => $data['id'],
    		'quantity' => $data['quantity'],
    		'po_id' => $data['pid']
        );
        $request = $this->_client->put($this->url.'pengadaan/pengadaan_confirm?username='.$this->id, array(), $input);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertTrue($body['status']);
        $this->assertEquals(201,$response->getStatusCode());

        return $data;
    }

    /**
     * @depends testConfirmUpdatePanadolStock
     */

    public function testDeletePanadol($data){
        $request = $this->_client->delete($this->url
                    .'pengadaan/obat?username='.$this->id.'&id='.$data['id']);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertTrue($body['status']);
        $this->assertEquals(200,$response->getStatusCode());

    }

    /**
     * @depends testLoginRequests
     */

    // public function testGetUser($token){
    //     $request = $this->_client->get($this->url.'admin/data');
    //     $request->addHeader('Authorization', $token);
    //     $response = $request->send();
    //     $body = $response->json();
    //     $this->assertEquals(200,$response->getStatusCode());
    //     $this->assertNotNull($body);
    // }


    // public function testAnotherRequest()
    // {
    //     $mockResponse = new Response(200);
    //     $mockResponseBody = EntityBody::factory(fopen('./mock/bodies/body1.txt', 'r+'));
    //     $mockResponse->setBody($mockResponseBody);
    //     $mockResponse->setHeaders(array(
    //         "Host" => "httpbin.org",
    //         "User-Agent" => "curl/7.19.7 (universal-apple-darwin10.0) libcurl/7.19.7 OpenSSL/0.9.8l zlib/1.2.3",
    //         "Accept" => "application/json",
    //         "Content-Type" => "application/json"
    //     ));
    //     $plugin = new MockPlugin();
    //     $plugin->addResponse($mockResponse);
    //     $client = new HttpClient();
    //     $client->addSubscriber($plugin);
    //
    //     $request = $client->get('https://api.freeagent.com/v2/invoices');
    //     $response = $request->send();
    //
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertTrue(in_array('Host', array_keys($response->getHeaders()->toArray())));
    //     $this->assertTrue($response->hasHeader("User-Agent"));
    //     $this->assertCount(4, $response->getHeaders());
    //     $this->assertSame($mockResponseBody->getSize(), $response->getBody()->getSize());
    //     $this->assertSame(1, count(json_decode($response->getBody(true))->invoices));
    // }
    //
    // public function testWithRemoteServer()
    // {
    //     $mockProperties = array(
    //         array(
    //             'header' => './mock/headers/header1.txt',
    //             'body' => './mock/bodies/body1.txt',
    //             'status' => 200
    //         )
    //     );
    //     $mockResponses = array();
    //
    //     foreach($mockProperties as $property) {
    //         $mockResponse = new Response($property['status']);
    //         $mockResponseBody = EntityBody::factory(fopen($property['body'], 'r+'));
    //         $mockResponse->setBody($mockResponseBody);
    //         $headers = explode("\n", file_get_contents($property['header'], true));
    //         foreach($headers as $header) {
    //             list($key, $value) = explode(': ', $header);
    //             $mockResponse->addHeader($key, $value);
    //         }
    //         $mockResponses[] = $mockResponse;
    //     }
    //
    //     $this->getServer()->enqueue($mockResponses);
    //
    //     $client = new HttpClient();
    //     $client->setBaseUrl($this->getServer()->getUrl());
    //     $request = $client->get();
    //     $request->getQuery()->set('view', 'recent_open_or_overdue');
    //     $response = $request->send();
    //
    //     $this->assertCount(5, $response->getHeaders());
    //     $this->assertEmpty($response->getContentDisposition());
    //     $this->assertSame('HTTP', $response->getProtocol());
    // }

    public function tearDown()
    {

    }
}
