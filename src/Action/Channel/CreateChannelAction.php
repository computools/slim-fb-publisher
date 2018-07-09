<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Entity\Channel;
use App\Exception\Channel\ChannelAlreadyExistsException;
use App\Repository\ChannelRepository;
use App\Response\Channel\ChannelTransformer;
use Slim\Http\Response;

class CreateChannelAction extends ApiAction
{
	public function execute(): Response
	{
		$facebookService = $this->getFacebookService();
		$channelRepository = $this->getRepository(ChannelRepository::class);

		$accessToken = $facebookService->getTokenByCode();
		$clientData = $facebookService->getClientData($accessToken);

		$facebookId = $clientData['id'];
		if ($channelRepository->findOneBy([
			'facebook_id' => $facebookId
		])) {
			throw new ChannelAlreadyExistsException();
		}

		$channel = new Channel();
		$channel->setUser($this->getUser());
		$channel->setFacebookId($facebookId);
		$channel->setAccessToken($accessToken->getValue());
		$channel->setExpiresAt($accessToken->getExpiresAt());

		return $this->response(
			$this->item($channelRepository->save($channel), new ChannelTransformer()),
			201
		);
	}
}