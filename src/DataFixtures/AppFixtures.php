<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher =$hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //Utilisation de Faker
        $faker = Factory::create('fr_FR');

        //Création d'un Utilisateur
        $user = new User();

        $user->setEmail('admin@gmail.com')
            ->setPrenom($faker->firstName())
            ->setNom($faker->lastName())
            ->setRoles((array)'ROLE_ADMIN')
            ->setTelephone(0610755754);


        $password = $this->hasher->hashPassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
