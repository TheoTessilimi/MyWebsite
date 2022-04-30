<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {

        //utilisateur de test roles : user
        $user = new User();
        $user->setFirstname('firstname_user')
            ->setLastname('lastname_user')
            ->setPseudo('pseudo_user')
            ->setEmail('test@user.com');
        //hash password and set it to the user
        $passwordHashed = $this->hasher->hashPassword($user, 'password_user');
        $user->setPassword($passwordHashed);
        //envoie sur bdd
        $manager->persist($user);
        $manager->flush();
    }
}