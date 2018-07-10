<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Repository\PostRepository;
use App\Response\Post\PostTransformer;
use Computools\CLightORM\Tools\Pagination;
use Slim\Http\Response;

class PostListAction extends ApiAction
{
	public function execute(): Response
	{
		/**
		 * @var PostRepository $repository
		 */
		$repository = $this->getRepository(PostRepository::class);

		$posts = $repository->findByUser($this->getUser(), ['themes'], (new Pagination())->setPagination(
			$this->getRequest()->getQueryParam('page', 1),
			$this->getRequest()->getQueryParam('per_page', 20)
		));

		return $this->response(
			$this->collection($posts, new PostTransformer())
		);
	}
}