<?php

namespace App\Action\Auth;

use App\Action\ApiAction;
use App\Entity\User;
use App\Exception\User\InvalidCredentialsException;
use App\Exception\User\UserNotFoundException;
use App\Helper\CryptHelper;
use App\Helper\TokenHelper;
use App\Repository\UserRepository;
use App\Response\Token\TokenTransformer;
use Slim\Http\Response;

class LoginAction extends ApiAction
{
	public function execute(): Response
	{
		$params = $this->getRequest()->getParams();

		$userRepository = $this->getRepository(UserRepository::class);

		/**
		 * @var User|null $user
		 */
		if (!$user = $userRepository->findOneBy([
			'email' => $params['email']
		])) {
			throw new UserNotFoundException();
		}

		if (!CryptHelper::verify($params['password'], $user->getPassword())) {
			throw new InvalidCredentialsException();
		}

		return $this->response(
			$this->item(
				TokenHelper::createToken($user->getId(), $user->getEmail(), $this->getContainer()['settings']['jwt']),
				new TokenTransformer()
			)
		);
	}
}