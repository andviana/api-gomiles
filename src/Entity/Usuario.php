<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\ManyToOne(targetEntity: Pessoa::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(nullable: false)]
    private $pessoa;

    #[ORM\Column(type: 'datetime')]
    private $dataCadastro;

    #[ORM\Column(type: 'datetime')]
    private $dataAtualizacao;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $ativo;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\OneToMany(mappedBy: 'usuarioFechamento', targetEntity: Caixa::class)]
    private $caixas;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Movimento::class)]
    private $movimentos;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: RegistroEntrada::class)]
    private $registroEntradas;

    #[ORM\Column(type: 'guid')]
    private $codigo;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: RegistroSaida::class)]
    private $registroSaidas;

    public function __construct()
    {
        $this->caixas = new ArrayCollection();
        $this->movimentos = new ArrayCollection();
        $this->registroEntradas = new ArrayCollection();
        $this->registroSaidas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function getPessoa(): ?Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(?Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    public function getDataCadastro(): ?\DateTimeInterface
    {
        return $this->dataCadastro;
    }

    public function setDataCadastro(\DateTimeInterface $dataCadastro): self
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    public function getDataAtualizacao(): ?\DateTimeInterface
    {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao(\DateTimeInterface $dataAtualizacao): self
    {
        $this->dataAtualizacao = $dataAtualizacao;

        return $this;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(?bool $ativo): self
    {
        $this->ativo = $ativo;

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
     * @return Collection|Caixa[]
     */
    public function getCaixas(): Collection
    {
        return $this->caixas;
    }

    public function addCaixa(Caixa $caixa): self
    {
        if (!$this->caixas->contains($caixa)) {
            $this->caixas[] = $caixa;
            $caixa->setUsuarioFechamento($this);
        }

        return $this;
    }

    public function removeCaixa(Caixa $caixa): self
    {
        if ($this->caixas->removeElement($caixa)) {
            // set the owning side to null (unless already changed)
            if ($caixa->getUsuarioFechamento() === $this) {
                $caixa->setUsuarioFechamento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Movimento[]
     */
    public function getMovimentos(): Collection
    {
        return $this->movimentos;
    }

    public function addMovimento(Movimento $movimento): self
    {
        if (!$this->movimentos->contains($movimento)) {
            $this->movimentos[] = $movimento;
            $movimento->setUsuario($this);
        }

        return $this;
    }

    public function removeMovimento(Movimento $movimento): self
    {
        if ($this->movimentos->removeElement($movimento)) {
            // set the owning side to null (unless already changed)
            if ($movimento->getUsuario() === $this) {
                $movimento->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RegistroEntrada[]
     */
    public function getRegistroEntradas(): Collection
    {
        return $this->registroEntradas;
    }

    public function addRegistroEntrada(RegistroEntrada $registroEntrada): self
    {
        if (!$this->registroEntradas->contains($registroEntrada)) {
            $this->registroEntradas[] = $registroEntrada;
            $registroEntrada->setUsuario($this);
        }

        return $this;
    }

    public function removeRegistroEntrada(RegistroEntrada $registroEntrada): self
    {
        if ($this->registroEntradas->removeElement($registroEntrada)) {
            // set the owning side to null (unless already changed)
            if ($registroEntrada->getUsuario() === $this) {
                $registroEntrada->setUsuario(null);
            }
        }

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @return Collection|RegistroSaida[]
     */
    public function getRegistroSaidas(): Collection
    {
        return $this->registroSaidas;
    }

    public function addRegistroSaida(RegistroSaida $registroSaida): self
    {
        if (!$this->registroSaidas->contains($registroSaida)) {
            $this->registroSaidas[] = $registroSaida;
            $registroSaida->setUsuario($this);
        }

        return $this;
    }

    public function removeRegistroSaida(RegistroSaida $registroSaida): self
    {
        if ($this->registroSaidas->removeElement($registroSaida)) {
            // set the owning side to null (unless already changed)
            if ($registroSaida->getUsuario() === $this) {
                $registroSaida->setUsuario(null);
            }
        }

        return $this;
    }
}
