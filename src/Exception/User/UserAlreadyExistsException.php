<?php

namespace App\Exception\User;

use App\Exception\ConflictApiException;

class UserAlreadyExistsException extends ConflictApiException
{
	protected $message = 'User already registered';
}