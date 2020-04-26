<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Throwable;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setUsername('dale');
        $user->setForename('Dale');
        $user->setSurname('Nash');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        try {
            $user->setCardScrambler(random_int(0, 1000) . ':' . random_int(0, 1000));
        } catch (Throwable $t) {
            error_log($t->getMessage());

            return;
        }

        $manager->persist($user);
        $manager->flush();
    }
}
