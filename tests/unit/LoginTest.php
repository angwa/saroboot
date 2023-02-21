<?php
require_once 'PHPUnit/Autoload.php';

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


class LoginTest extends TestCase
{
	function testLogin()
	{
		$client = new Client([
			'base_uri' => 'http://localhost',
			'request.options' => [
				'exceptions' => false
			],
			'headers' => [
				'Content-Type'  => 'application/json',
				'Accept'        => 'application/json',
			]
		]);

		$data = array(
			'email' => 'test@mai.com',
			'password' => '123'
		);
		$response = $client->post('/saroboot/api/login', ["body" => json_encode($data)]);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertTrue($response->hasHeader('Access-Control-Allow-Headers'));
		$this->assertArrayHasKey('email', $data);
	}
}
