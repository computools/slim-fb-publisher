<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Entity\Post;
use App\Exception\Post\PostNotFoundException;
use App\Repository\PostRepository;
use App\Repository\ThemeRepository;
use App\Response\Post\SinglePostTransformer;
use Slim\Http\Response;

class UpdatePostAction extends ApiAction
{
	public function execute(): Response
	{
		$postId = $this->getPathParam('postId');
		$repository = $this->getRepository(PostRepository::class);
		/**
		 * @var Post|null $post
		 */
		if (!$post = $repository->find($postId, ['theme'])) {
			throw new PostNotFoundException();
		}

		$params = $this->getRequest()->getParams();
		$post->setTitle($params['title']);
		$post->setContent($params['content']);

		$repository->save($post, ['theme'], true);
		return $this->response(
			$this->item($post, new SinglePostTransformer())
		);
	}
}