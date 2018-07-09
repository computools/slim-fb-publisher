<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Repository\ChannelRepository;
use App\Response\Channel\ChannelTransformer;
use Slim\Http\Response;

class ListChannelsAction extends ApiAction
{
	public function execute(): Response
	{
		$channelRepository = $this->getRepository(ChannelRepository::class);
		return $this->response(
			$this->collection($channelRepository->findBy([
				'user_id' => $this->getUser()->getId()
			]), new ChannelTransformer())
		);
	}
}