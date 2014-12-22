<?php
namespace ZIMZIM\UserBundle\Security\Core\User;

class LoginTwitter extends Login
{

    public function checkIfExist()
    {
        $username = $this->response->getRealName();

        $user = $this->userManager->findUserBy(array('username' => $username));

        if (isset($user)) {
            $this->initialiseUser($user);

            return $user;
        }

        $usernamebis = $this->response->getNickname();

        $user = $this->userManager->findUserBy(array('username' => $usernamebis));

        if (isset($user)) {
            $this->initialiseUser($user);

            return $user;
        }

        return null;
    }

    public function logMe()
    {
        $user = $this->initialiseUser();
        $user->setUsername($this->response->getRealName());
        $user->setEmail($this->response->getRealName());
        $user->setPlainPassword($this->response->getRealName());
        $user->setEnabled(true);
        $this->userManager->updateUser($user);

        return $user;
    }
}