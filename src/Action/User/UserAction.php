<?php

namespace App\Action\User;

use App\Action\ApiAction;
use App\Response\User\UserTransformer;
use Slim\Http\Response;

class UserAction extends ApiAction
{
	public function execute(): Response
	{
		return $this->response(
			$this->item($this->getUser(), new UserTransformer())
		);
	}
}