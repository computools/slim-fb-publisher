<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Response\Post\PostTransformer;
use Slim\Http\Response;

class CreatePostAction extends ApiAction
{
	public function execute(): Response
	{
		$postRepository = $this->getRepository(PostRepository::class);
		$params = $this->getRequest()->getParams();

		$post = new Post();
		$post->setTitle($params['title']);
		$post->setContent($params['content']);
		$post->setUser($this->getUser());

		return $this->response($this->item(
			$postRepository->save($post),
			new PostTransformer()
		), 201);
	}
}