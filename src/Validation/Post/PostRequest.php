<?php

namespace App\Validation\Post;

use App\Validation\AbstractValidator;

use Respect\Validation\Validator;

class PostRequest extends AbstractValidator
{
	public function rules(): array
	{
		return [
			'title' => Validator::stringType()->length(5, 255)->setTemplate('Title length must be greater than 5 and less then 255'),
			'content' => Validator::stringType()
		];
	}
}