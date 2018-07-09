<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Repository\ThemeRepository;
use App\Response\Theme\ThemeTransformer;
use Computools\LessqlORM\Repository\Pagination;
use Slim\Http\Response;

class ListThemesAction extends ApiAction
{
	public function execute(): Response
	{
		$repository = $this->getRepository(ThemeRepository::class);

		$themes = $repository->findBy([
			'user_id' => $this->getUser()->getId()
		], [], (new Pagination())->setPagination(
			$this->getRequest()->getQueryParam('page', 1),
			$this->getRequest()->getQueryParam('per_page', 20)
		));

		return $this->response(
			$this->collection(
				$themes,
				new ThemeTransformer()
			)
		);
	}
}