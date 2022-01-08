<?php

namespace App\DataFixtures;

use App\Entity\Pessoa;
use App\Factories\UserFactory;
use App\Security\UserRoleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(private UserFactory $userFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $pessoa = new Pessoa();
        $pessoa
            ->setCpf('11111111111')
            ->setNome('Administrador do Sistema')
            ->setDataNascimento(new \DateTime());

        $userAdmin = $this->userFactory->create(
            email: 'admin@email.com',
            username: 'admin',
            plainPassword: '123456',
            person: $pessoa,
            roleType: UserRoleType::Admin
        );

        $manager->persist($pessoa);
        $manager->persist($userAdmin);
        $manager->flush();
    }
}
