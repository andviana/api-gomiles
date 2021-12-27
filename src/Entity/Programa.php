<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProgramaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramaRepository::class)]
#[ApiResource]
class Programa
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
    private $descricao;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\OneToMany(mappedBy: 'programa', targetEntity: RegistroEntrada::class)]
    private $registroEntradas;

    #[ORM\OneToMany(mappedBy: 'Programa', targetEntity: RegistroSaida::class)]
    private $registroSaidas;

    public function __construct()
    {
        $this->registroEntradas = new ArrayCollection();
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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

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
            $registroEntrada->setPrograma($this);
        }

        return $this;
    }

    public function removeRegistroEntrada(RegistroEntrada $registroEntrada): self
    {
        if ($this->registroEntradas->removeElement($registroEntrada)) {
            // set the owning side to null (unless already changed)
            if ($registroEntrada->getPrograma() === $this) {
                $registroEntrada->setPrograma(null);
            }
        }

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
            $registroSaida->setPrograma($this);
        }

        return $this;
    }

    public function removeRegistroSaida(RegistroSaida $registroSaida): self
    {
        if ($this->registroSaidas->removeElement($registroSaida)) {
            // set the owning side to null (unless already changed)
            if ($registroSaida->getPrograma() === $this) {
                $registroSaida->setPrograma(null);
            }
        }

        return $this;
    }
}
