<?php

namespace App\Validation\Auth;

use App\Validation\AbstractValidator;

use Respect\Validation\Validator;

class RegisterRequest extends AbstractValidator
{
	public function rules(): array
	{
		return [
			'email' => Validator::email()->setTemplate('Must be a valid email address'),
			'password' => Validator::stringType()->length(6)->setTemplate('Password length must be greater than 6')
		];
	}
}