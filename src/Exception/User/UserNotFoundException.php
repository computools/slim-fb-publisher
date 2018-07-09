<?php

namespace App\Exception\User;

use App\Exception\ApiException;
use App\Exception\NotFoundApiException;

class UserNotFoundException extends NotFoundApiException
{
	protected $message = 'User not found';
}