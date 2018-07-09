<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Entity\Post;
use App\Exception\Post\PostNotFoundException;
use App\Repository\PostRepository;
use App\Response\Post\SinglePostTransformer;
use Slim\Http\Response;

class GetPostAction extends ApiAction
{
	public function execute(): Response
	{
		/**
		 * @var Post $post
		 */
		if (!$post = $this->getRepository(PostRepository::class)->findOneBy([
			'id' => $this->getPathParam('postId'),
			'user_id' => $this->getUser()->getId()
		], [
			'publications' => [
				'channel'
			]
		])) {
			throw new PostNotFoundException();
		}

		return $this->response(
			$this->item($post, new SinglePostTransformer())
		);
	}
}