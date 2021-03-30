<?php
require_once 'PHPUnit/Autoload.php';
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


class LogoutTest extends TestCase
{
	function testLogout()
	{
		$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MTcwNzY0NjQsImV4cCI6MTYxNzQzNjQ2NCwiaXNzIjoibG9jYWxob3N0IiwiZGF0YSI6eyJpZCI6IjEiLCJmaXJzdG5hbWUiOiJKb2huIiwibGFzdG5hbWUiOiJEYW5pZWwiLCJlbWFpbCI6InRlc3RAbWFpbC5jb20ifX0.JYSLV2AWWGm_KsDLhazfnT-2Wya8cajJRURtLRBKyko";

		$client = new Client([
			'base_uri' => 'http://localhost',
			'request.options' => [
				'exceptions' => false
			],
	        'headers' => [
	            'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
                'Authorization'=> "Bearer $token"
	    ]]);

		$response = $client->get('/saroboot/api/logout');
	 
	    $this->assertEquals(200, $response->getStatusCode());
	    $this->assertTrue($response->hasHeader('Access-Control-Allow-Headers'));
	}

}