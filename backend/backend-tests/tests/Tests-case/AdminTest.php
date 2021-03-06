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


class AdminTest extends GuzzleTestCase
{
    protected $_client;
    protected $url = 'http://localhost/apotekkppl/backend/user/';
    protected $token;
    protected $id = 'rama';

    public function setUp()
    {
        $this->_client = new ServiceClient();
        $this->token = "";
    }
    
    public function testAdminLogin()
    {
        // The following request will get the mock response from the plugin in FIFO order
        $data = [
            'username' => $this->id,
            'password' => 'rama'
        ];
        $request = $this->_client->post($this->url.'login', array(), array('input'=>$data));
        $response = $request->send();
        // echo $response;
        $body = $response->json();

        $this->token = 'Bearer '.$body['data']['token'];
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($body['status']);
        $this->assertNotNull($body['data']['token']);
        return $this->token;
    }

    /**
     * @depends testAdminLogin
     */

    public function testCreateUserAnon($token){
        $input = array(
            'username' => 'Anon',
            'password' => 'anon',
            'name' => 'mynameisanon',
            'email' => 'anon@gmail.com',
            'telp' => '000021',
            'role' => 2
        );
        $request = $this->_client->post($this->url.'admin/data?username='.$this->id, array(), $input);
        $request->addHeader('authorization', $token);
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(201,$response->getStatusCode());
        $this->assertNotNull($body);
        $data = [
            'token' => $token,
            'username' => $input['username']
        ];
        return $data;
    }

    /**
     * @depends testCreateUserAnon
     */

    public function testGetAllUser($data){
        $request = $this->_client->get($this->url.'admin/data?username='.$this->id);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        // echo $response;
        $body = $response->json();
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotNull($body);
        $countuser = count($body);
        $this->assertContains($data['username'], $body[$countuser-1]['u_username']);
        $data['id'] = $body[$countuser-1]['u_id'];

        return $data;
    }

    /**
     * @depends testGetAllUser
     */

    public function testGetUserAnon($data){
        $request = $this->_client->get($this->url.'admin/data?username='.$this->id.'&id='.$data['id']);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        // echo $response;
        $body = $response->json();
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertNotNull($body);
        $countuser = count($body);
        $this->assertContains($data['username'], $body[$countuser-1]['u_username']);
        $data['id'] = $body[$countuser-1]['u_id'];

        return $data;
    }

    /**
     * @depends testGetAllUser
     */

    public function testGetUserX($data){
        $request = $this->_client->get($this->url.'admin/data?username='.$this->id.'&id=9999999');
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        // echo $response;
        $body = $response->json();
        $this->assertEquals(200,$response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
        // $countuser = count($body);
        // $this->assertContains($data['username'], $body[$countuser-1]['u_username']);
        // $data['id'] = $body[$countuser-1]['u_id'];

        return $data;
    }

    /**
     * @depends testGetUserAnon
     */

    public function testChangeAnonEmail($data){
        $input = array(
            'u_email' => 'emailngasal@gmail.com'
        );
        $request = $this->_client->put($this->url.'admin/change_email/'.$data['id'].'?username='.$this->id, array(), $input);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertTrue($body['status']);
        $this->assertEquals(200,$response->getStatusCode());

        return $data;
    }

    /**
     * @depends testChangeAnonEmail
     */

    public function testBannedAnon($data){
        
        $request = $this->_client->put($this->url.'admin/banned_user/'.$data['id'].'?username='.$this->id);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertTrue($body['status']);
        $this->assertEquals(200,$response->getStatusCode());

        return $data;
    }

    /**
     * @depends testChangeAnonEmail
     */

    public function testBannedAnonWithNoId($data){
        
        $request = $this->_client->put($this->url.'admin/banned_user?username='.$this->id);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertFalse($body['status']);
        $this->assertEquals(200,$response->getStatusCode());

        return $data;
    }

    /**
     * @depends testChangeAnonEmail
     */

    public function testBannedAnonWithRandomId($data){
        
        $request = $this->_client->put($this->url.'admin/banned_user/789123?username='.$this->id);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        echo $response;
        $this->assertNotNull($body);
        $this->assertFalse($body['status']);
        $this->assertEquals(200,$response->getStatusCode());

        return $data;
    }

    /**
     * @depends testChangeAnonEmail
     */

    public function testDeleteAnon($data){
        $request = $this->_client->delete($this->url
                    .'admin/data?username='.$this->id.'&id='.$data['id']);
        $request->addHeader('authorization', $data['token']);
        $response = $request->send();
        $body = $response->json();
        $this->assertNotNull($body);
        $this->assertTrue($body['status']);
        $this->assertEquals(200,$response->getStatusCode());

        return $data;

    }



    /**
     * @depends testAdminLogin
     */

    public function testAccessApotekerForbidden($token){

        $request = $this->_client->get($this->url.'apoteker?username='.$this->id);
        $request->addHeader('authorization', $token);
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testAdminLogin
     */

    public function testAccessKasirForbidden($token){

        $request = $this->_client->get($this->url.'kasir?username='.$this->id);
        $request->addHeader('authorization', $token);
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testAdminLogin
     */

    public function testAccessPengadaanForbidden($token){

        $request = $this->_client->get($this->url.'pengadaan?username='.$this->id);
        $request->addHeader('authorization', $token);
        $response = $request->send();
        $body = $response->json();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse($body['status']);
        $this->assertNotNull($body);
    }

    /**
     * @depends testAdminLogin
     */

    public function testAccessPemilikForbidden($token){

        $request = $this->_client->get($this->url.'pemilik?username='.$this->id);
        $request->addHeader('authorization', $token);
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

    }
}
