<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Interfaces\IRoles;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture implements IRoles
{
    private $userPasswordHasher;

    public function __construct( UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setEmail('admin@blabla.fr');
        $user->addRoles(self::ROLE_ADMIN);
        $user->setNom('Do');
        $user->setPrenom('John');
        $user->setBadge('33');

        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "blibloblu"
        ));
        
        $manager->persist($user);
        $manager->flush();
    }
}
