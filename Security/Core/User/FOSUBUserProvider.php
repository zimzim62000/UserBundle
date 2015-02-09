<?php
namespace ZIMZIM\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        $service = $response->getResourceOwner()->getName();

        $setter = 'set' . ucfirst($service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';

        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }

        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $service = $response->getResourceOwner()->getName();
        $idservice = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $idservice));

        $classname = 'ZIMZIM\UserBundle\Security\Core\User\Login' . ucfirst($service);
        $login = new $classname($this->userManager, $response);

        if ($user == null) {
            $user = $login->checkIfExist();

            if ($user == null) {
                $user = $login->logMe();
            }

            return $user;
        }

        $user = parent::loadUserByOAuthUserResponse($response);
        $setter = 'set' . ucfirst($service) . 'AccessToken';
        $user->$setter($response->getAccessToken());

        return $user;
    }

}
