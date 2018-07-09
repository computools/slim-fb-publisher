<?php

namespace App\Service;

use App\Entity\Publication;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Facebook;

class FacebookService
{
	private $facebook;
	private $redirectUri;

	public function __construct(Facebook $facebook, string $redirectUri)
	{
		$this->facebook = $facebook;
		$this->redirectUri = $redirectUri;
	}

	public function getAuthUrl(): string
	{
		return $this->facebook->getRedirectLoginHelper()->getLoginUrl($this->redirectUri, [
			'publish_actions',
			'user_posts'
		]);
	}

	public function getTokenByCode(): AccessToken
	{
		return $this->facebook->getRedirectLoginHelper()->getAccessToken($this->redirectUri);
	}

	public function getClientData(AccessToken $accessToken): array
	{
		$response = $this->facebook->get('/me', $accessToken);
		if ($response->isError()) {
			throw new FacebookResponseException($response);
		}
		return $response->getDecodedBody();
	}

	public function publish(Publication $publication): Publication
	{
		try {
			$response = $this->facebook->post(
				'/me/feed',
				[
					'message' => $publication->getPost()->getContent()
				],
				$publication->getChannel()->getAccessToken()
			);
			if ($response->isError()) {
				$publication->setSuccess(false);
			} else {
				$publication->setSuccess(true);
				$publication->setFacebookId($response->getDecodedBody()['id']);
			}
		} catch (FacebookResponseException $exception) {
			$publication->setSuccess(false);
			$publication->setErrorMessage($exception->getMessage());
		} catch (\Exception $exception) {
			$publication->setSuccess(false);
		}
		return $publication;
	}
}