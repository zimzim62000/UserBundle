<?php

namespace ZIMZIM\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $zimzim = new User();
        $zimzim->setEmail('admin@email.com');
        $zimzim->setPlainPassword('password');
        $zimzim->addRole('ROLE_ADMIN');
        $zimzim->setEnabled(true);
        $zimzim->setUsername('admin');
        $zimzim->setFirstname('Pépito');
        $zimzim->setLastname('Mekolasonne');
        $om->persist($zimzim);
        $this->addReference('admin', $zimzim);

        $zimzim = new User();
        $zimzim->setEmail('user@email.com');
        $zimzim->setPlainPassword('password');
        $zimzim->addRole('ROLE_USER');
        $zimzim->setEnabled(true);
        $zimzim->setUsername('user');
        $zimzim->setFirstname('renardo');
        $zimzim->setLastname('delospoulos');
        $om->persist($zimzim);
        $this->addReference('user', $zimzim);

        $om->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}