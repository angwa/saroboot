<?php
require_once 'PHPUnit/Autoload.php';

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


class RegisterTest extends TestCase
{
	function testRegistration()
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
			'firstname' => "John",
			'lastname' => "Doe",
			'email' => 'test@test.mail',
			'password' => '123',
			'secret_key' => 'fifdjfjfhnchjhhscfsfsnscfhsjf'
		);
		$response = $client->post('/saroboot/api/register', ["body" => json_encode($data)]);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertTrue($response->hasHeader('Access-Control-Allow-Headers'));
		$this->assertArrayHasKey('email', $data);
	}
}
