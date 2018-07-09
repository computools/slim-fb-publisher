<?php

namespace Tests\Functional;

class RegistrationTest extends BaseTestCase
{
	private $login;
	private $password = '123456';

	public function testRegistration()
	{
		$this->login = sprintf(
			"%s@test.com",
			$this->getRandomString()
		);

		$response = $this->runApp('POST', '/api/auth/register', [
			'email' => $this->login,
			'password' => $this->password
		]);

		$responseData = $this->getResponseData($response);
		$this->assertEquals($response->getStatusCode(), 200);
		$this->assertArrayHasKey('data', $responseData);
		$this->assertArrayHasKey('token', $responseData['data']);

		return $responseData['data']['token'];
	}

	public function testLogin()
	{
		$response = $this->runApp('POST', '/api/auth/login', [
			'email' => $this->login,
			'password' => $this->password
		]);

		$responseData = $this->getResponseData($response);
		$this->assertEquals($response->getStatusCode(), 200);
		$this->assertArrayHasKey('data', $responseData);
		$this->assertArrayHasKey('token', $responseData['data']);
	}
}