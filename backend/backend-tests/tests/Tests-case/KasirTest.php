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

class KasirTest extends GuzzleTestCase
{
    protected $_client;
    protected $url = 'http://localhost/APOTEK-KPPL/backend/user/';
    protected $token;
    protected $id = 'rama4';

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
        $data = [
            'token' => $this->token
        ];
        return $data;
    }

    /**
     * @depends testLoginRequests
     */

     public function testGetRequestObatList($data){
         $request = $this->_client->get($this->url.'kasir/request_obat?username='.$this->id);
         $request->addHeader('authorization', $data['token']);
         $response = $request->send();
         $body = $response->json();
         $this->assertEquals(200,$response->getStatusCode());
         $this->assertNotNull($body);
         $countuser = count($body);
         $data['id'] = $body[$countuser-1]['o_id'];
         $data['rid'] = $body[$countuser-1]['ro_id'];
         $data['quantity'] = $body[$countuser-1]['ro_quantity'];

         return $data;
     }

     /**
      * @depends testGetRequestObatList
      */

     public function testConfirmUpdatePanadolStock($data){
         $input = array(
            'o_id' => $data['id'],
     		'quantity' => $data['quantity'],
     		'ro_id' => $data['rid']
         );
         $request = $this->_client->put($this->url.'kasir/payment?username='.$this->id, array(), $input);
         $request->addHeader('authorization', $data['token']);
         $response = $request->send();
         $body = $response->json();
         $this->assertNotNull($body);
         $this->assertTrue($body['status']);
         $this->assertEquals(201,$response->getStatusCode());

         return $data;
     }
}
