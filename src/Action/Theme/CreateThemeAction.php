<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Entity\Theme;
use App\Repository\ThemeRepository;
use App\Response\Theme\ThemeTransformer;
use Slim\Http\Response;

class CreateThemeAction extends ApiAction
{
	public function execute(): Response
	{
		$themeRepository = $this->getRepository(ThemeRepository::class);

		$theme = new Theme();
		$theme->setTitle($this->getRequest()->getParam('title'));
		$theme->setUser($this->getUser());
		return $this->response(
			$this->item($themeRepository->save($theme), new ThemeTransformer())
		);
	}
}