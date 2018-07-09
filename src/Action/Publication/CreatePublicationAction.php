<?php

namespace App\Action\Publication;

use App\Action\ApiAction;
use App\Entity\Publication;
use App\Exception\Channel\ChannelNotFoundException;
use App\Exception\Post\PostNotFoundException;
use App\Repository\ChannelRepository;
use App\Repository\PostRepository;
use App\Repository\PublicationRepository;
use App\Response\Publication\PublicationTransformer;
use Slim\Http\Response;

class CreatePublicationAction extends ApiAction
{
	public function execute(): Response
	{
		if (!$post = $this->getRepository(PostRepository::class)->findOneBy([
			'id' => $this->getPathParam('postId'),
			'user_id' => $this->getUser()->getId()
		])) {
			throw new PostNotFoundException();
		}

		if (!$channel = $this->getRepository(ChannelRepository::class)->findOneBy([
			'id' => $this->getPathParam('channelId'),
			'user_id' => $this->getUser()->getId()
		])) {
			throw new ChannelNotFoundException();
		}

		$publication = new Publication();
		$publication->setPost($post);
		$publication->setChannel($channel);

		return $this->response($this->item(
			$this->getRepository(PublicationRepository::class)->save(
				$this->getFacebookService()->publish($publication),
				['post', 'channel']
			),
			new PublicationTransformer()
		), 201);
	}
}