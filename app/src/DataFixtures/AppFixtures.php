<?php

namespace App\DataFixtures;

use App\Entity\Cast;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ApiToken;
use App\Entity\User;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    private const API_TOKEN = '5d554081460ad848858d50dedea2f0deeedc7042c3c84b1b2a348dc9fbc71ee57975bd496f566990e43afba7c8200a633a013b499914db84e9812e68';

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('arpita.rana212@gmail.com');
        $user->setPassword('arpita');
        $user->setSalt('12333');
        $user->setUserName('arpi@test.tech');
        $manager->persist($user);

        $apiToken = new ApiToken();
        $apiToken->setToken(self::API_TOKEN);
        $apiToken->setUser($user);
        $manager->persist($apiToken);


        $cast = new Cast();
        $cast->setName('DiCaprio');
        $manager->persist($cast);

        $cast = new Cast();
        $cast->setName('Kate Winslet');

        $manager->persist($cast);

        $manager->flush();
    }
}
