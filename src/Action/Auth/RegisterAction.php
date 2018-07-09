<?php

namespace App\Action\Auth;

use App\Action\ApiAction;
use App\Entity\User;
use App\Exception\User\UserAlreadyExistsException;
use App\Helper\CryptHelper;
use App\Helper\TokenHelper;
use App\Repository\UserRepository;
use App\Response\Token\TokenTransformer;
use Slim\Http\Response;

class RegisterAction extends ApiAction
{
	public function execute(): Response
	{
		$params = $this->getRequest()->getParams();
		$userRepository = $this->getRepository(UserRepository::class);

		if ($user = $userRepository->findOneBy(['email' => $params['email']])) {
			throw new UserAlreadyExistsException();
		}

		$user = new User();
		$user->setEmail($params['email']);
		$user->setPassword(CryptHelper::hash($params['password']));
		$user = $userRepository->save($user);

		return $this->response(
			$this->item(
				TokenHelper::createToken(
					$user->getId(),
					$params['email'],
					$this->getContainer()['settings']['jwt']
				),
				new TokenTransformer()
			)
		);
	}
}