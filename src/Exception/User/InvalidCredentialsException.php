<?php

namespace App\Exception\User;

use App\Exception\NotFoundApiException;

class InvalidCredentialsException extends NotFoundApiException
{
	protected $message = 'Invalid credentials';
}