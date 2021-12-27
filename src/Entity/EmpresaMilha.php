<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EmpresaMilhaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaMilhaRepository::class)]
#[ApiResource]
class EmpresaMilha
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nome;

    #[ORM\Column(type: 'string', length: 255)]
    private $logo;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\OneToMany(mappedBy: 'empresaMilha', targetEntity: RegistroSaida::class)]
    private $registroSaidas;

    public function __construct()
    {
        $this->registroSaidas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
            $registroSaida->setEmpresaMilha($this);
        }

        return $this;
    }

    public function removeRegistroSaida(RegistroSaida $registroSaida): self
    {
        if ($this->registroSaidas->removeElement($registroSaida)) {
            // set the owning side to null (unless already changed)
            if ($registroSaida->getEmpresaMilha() === $this) {
                $registroSaida->setEmpresaMilha(null);
            }
        }

        return $this;
    }
}
