<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\Table('Clients')]
#[ApiResource(
    normalizationContext: [
        'groups' => ['Client:Read']
    ],
    denormalizationContext: [
        'groups' => ['Client:Write']
    ],
    collectionOperations: [
        'get',
        'post'
    ],
    itemOperations: [
        'put',
        'get',
        'delete'
    ]
)]
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 15)]
    #[Groups(['Client:Read'])]
    private $codeCli;

    #[ORM\Column(type: 'string', length: 40)]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $lastName;

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $firstName;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $email;

    #[ORM\Column(type: 'json')]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 150)]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $password;

    #[ORM\Column(type: 'string', length: 11, unique: true)]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $telephone;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    #[Groups(['Client:Read', 'Client:Write'])]
    private $cardNumber;
    

    public function getCodeCli(): string
    {
        return $this->codeCli;
    }

    public function setCodeCli(string $codeCli)
    {
        $this->codeCli = $codeCli;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    } 
}