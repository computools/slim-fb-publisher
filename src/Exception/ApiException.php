<?php

namespace App\Exception;

use Slim\Exception\SlimException;
use Throwable;

class ApiException extends \Exception
{
	protected $message = 'Internal Server Error';
	protected $statusCode = 500;

	public function __construct()
	{
		parent::__construct($this->message, $this->statusCode);
	}
}