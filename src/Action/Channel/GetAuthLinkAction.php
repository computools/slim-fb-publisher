<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Response\Channel\AuthLinkTransformer;
use Slim\Http\Response;

class GetAuthLinkAction extends ApiAction
{
	public function execute(): Response
	{
		return $this->response(
			$this->item($this->getFacebookService()->getAuthUrl(), new AuthLinkTransformer())
		);
	}
}