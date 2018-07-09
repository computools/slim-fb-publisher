<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Entity\Post;
use App\Exception\Post\PostNotFoundException;
use App\Repository\PostRepository;
use Slim\Http\Response;

class RemovePostAction extends ApiAction
{
	public function execute(): Response
	{
		$postId = $this->getPathParam('postId');
		$postRepository = $this->getRepository(PostRepository::class);

		/**
		 * @var Post $post
		 */
		if (!$post = $postRepository->find($postId)) {
			throw new PostNotFoundException();
		}

		$postRepository->remove($post);
		return $this->response([], 204);
	}
}