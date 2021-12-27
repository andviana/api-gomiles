<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TipoSaidaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoSaidaRepository::class)]
#[ApiResource]
class TipoSaida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $descricao;

    #[ORM\OneToMany(mappedBy: 'tipoSaida', targetEntity: RegistroSaida::class)]
    private $registroSaidas;

    public function __construct()
    {
        $this->registroSaidas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

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
            $registroSaida->setTipoSaida($this);
        }

        return $this;
    }

    public function removeRegistroSaida(RegistroSaida $registroSaida): self
    {
        if ($this->registroSaidas->removeElement($registroSaida)) {
            // set the owning side to null (unless already changed)
            if ($registroSaida->getTipoSaida() === $this) {
                $registroSaida->setTipoSaida(null);
            }
        }

        return $this;
    }
}
