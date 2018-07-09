<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Exception\Theme\ThemeNotFoundException;
use App\Repository\ThemeRepository;
use Slim\Http\Response;

class RemoveThemeAction extends ApiAction
{
	public function execute(): Response
	{
		$themeRepository = $this->getRepository(ThemeRepository::class);
		if (!$theme = $themeRepository->findOneBy([
			'user_id' => $this->getUser()->getId(),
			'id' => $this->getPathParam('themeId')
		])) {
			throw new ThemeNotFoundException();
		}

		$themeRepository->remove($theme);
		return $this->response([], 204);
	}
}