<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TipoEntradaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoEntradaRepository::class)]
#[ApiResource]
class TipoEntrada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $descricao;

    #[ORM\OneToMany(mappedBy: 'tipoEntrada', targetEntity: RegistroEntrada::class)]
    private Collection $registroEntradas;

    public function __construct()
    {
        $this->registroEntradas = new ArrayCollection();
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
            $registroEntrada->setTipoEntrada($this);
        }

        return $this;
    }

    public function removeRegistroEntrada(RegistroEntrada $registroEntrada): self
    {
        if ($this->registroEntradas->removeElement($registroEntrada)) {
            // set the owning side to null (unless already changed)
            if ($registroEntrada->getTipoEntrada() === $this) {
                $registroEntrada->setTipoEntrada(null);
            }
        }

        return $this;
    }
}
