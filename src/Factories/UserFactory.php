<?php

namespace App\Factories;

use App\Entity\Pessoa;
use App\Entity\Usuario;
use App\Security\UserRoleType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(
        string $email,
        string $username,
        string $plainPassword,
        Pessoa $person,
        UserRoleType $roleType = UserRoleType::User,
        bool $active = true,
        \DateTime $createdAt=new \DateTime(),
        \DateTime $updateAt = new \DateTime(),
    ): Usuario
    {
        $user = new Usuario();
        $user
            ->setEmail($email)
            ->setUsername($username)
            ->setAtivo($active)
            ->setRoles([$roleType->value])
            ->setPassword($this->passwordHasher->hashPassword($user,$plainPassword))
            ->setPessoa($person)
            ->setDataCadastro($createdAt)
            ->setDataAtualizacao($updateAt);
        return $user;
    }
}