<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Entity\Post;
use App\Entity\Theme;
use App\Exception\Post\PostNotFoundException;
use App\Exception\Theme\ThemeNotFoundException;
use App\Repository\PostRepository;
use App\Repository\ThemeRepository;
use App\Response\Post\PostTransformer;
use Slim\Http\Response;

class AddPostThemeAction extends ApiAction
{
	public function execute(): Response
	{
		$postId = $this->getPathParam('postId');
		$themeId = $this->getPathParam('themeId');

		$postRepository = $this->getRepository(PostRepository::class);
		$themeRepository = $this->getRepository(ThemeRepository::class);

		/**
		 * @var Post $post
		 */
		if (!$post = $postRepository->find($postId)) {
			throw new PostNotFoundException();
		}

		/**
		 * @var Theme $theme
		 */
		if (!$theme = $themeRepository->find($themeId)) {
			throw new ThemeNotFoundException();
		}

		$post->addRelation($theme);
		return $this->response(
			$this->item($postRepository->save($post, ['theme']), new PostTransformer())
		);
	}
}