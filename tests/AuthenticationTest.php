<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Pessoa;
use App\Factories\UserFactory;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class AuthenticationTest extends ApiTestCase
{
    use ReloadDatabaseTrait;

    public function testLogin(): void
    {
        $client = self::createClient();
        $person = new Pessoa();
        $person
            ->setDataNascimento(new \DateTime())
            ->setNome('User Test')
            ->setCpf('00000000000');

        /** @var UserFactory $userFactory */
        $userFactory = static::getContainer()->get('app.factories.user');
        $user = $userFactory->create(
            'user@email.com', 'user_test', '$3CR3T', $person
        );

        $manager = static::getContainer()->get('doctrine')->getManager();
        $manager->persist($person);
        $manager->persist($user);
        $manager->flush();

        // retrieve a token
        $response = $client->request('POST', '/api/login', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'user_test',
                'password' => '$3CR3T',
            ],
        ]);

        $json = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);

        // test not authorized
        $client->request('GET', '/api/pessoas');
        $this->assertResponseStatusCodeSame(401);

        // test authorized
        $client->request('GET', '/api/pessoas', ['auth_bearer' => $json['token']]);
        $this->assertResponseIsSuccessful();
    }
}
