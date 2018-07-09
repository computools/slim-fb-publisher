<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Entity\Theme;
use App\Exception\Theme\ThemeNotFoundException;
use App\Repository\ThemeRepository;
use App\Response\Theme\ThemeTransformer;
use Slim\Http\Response;

class UpdateThemeAction extends ApiAction
{
	public function execute(): Response
	{
		/**
		 * @var ThemeRepository $themeRepository
		 */
		$themeRepository = $this->getRepository(ThemeRepository::class);

		/**
		 * @var Theme|null $theme
		 */
		if (!$theme = $themeRepository->findOneBy([
			'id' => $this->getPathParam('themeId'),
			'user_id' => $this->getUser()->getId()
		])) {
			throw new ThemeNotFoundException();
		}

		$theme->setTitle($this->getRequest()->getParam('title'));

		return $this->response($this->item($themeRepository->save($theme), new ThemeTransformer()));
	}
}