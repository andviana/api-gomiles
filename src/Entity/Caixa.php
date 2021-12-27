<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CaixaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaixaRepository::class)]
#[ApiResource]
class Caixa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $dataAbertura;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dataFechamento;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $ativo;

    #[ORM\Column(type: 'integer')]
    private $saldoMilhas;

    #[ORM\Column(type: 'integer')]
    private $totalEntradas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $valorEntradas;

    #[ORM\Column(type: 'integer')]
    private $totalSaidas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $valorSaidas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $valorEstoqueMilhasPeriodo;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $valorLucroMilhasPeriodo;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $valorMilhaPeriodo;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'caixas')]
    private $usuarioFechamento;

    #[ORM\OneToMany(mappedBy: 'caixa', targetEntity: Movimento::class)]
    private $movimentos;

    public function __construct()
    {
        $this->movimentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataAbertura(): ?\DateTimeInterface
    {
        return $this->dataAbertura;
    }

    public function setDataAbertura(\DateTimeInterface $dataAbertura): self
    {
        $this->dataAbertura = $dataAbertura;

        return $this;
    }

    public function getDataFechamento(): ?\DateTimeInterface
    {
        return $this->dataFechamento;
    }

    public function setDataFechamento(?\DateTimeInterface $dataFechamento): self
    {
        $this->dataFechamento = $dataFechamento;

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

    public function getSaldoMilhas(): ?int
    {
        return $this->saldoMilhas;
    }

    public function setSaldoMilhas(int $saldoMilhas): self
    {
        $this->saldoMilhas = $saldoMilhas;

        return $this;
    }

    public function getTotalEntradas(): ?int
    {
        return $this->totalEntradas;
    }

    public function setTotalEntradas(int $totalEntradas): self
    {
        $this->totalEntradas = $totalEntradas;

        return $this;
    }

    public function getValorEntradas(): ?string
    {
        return $this->valorEntradas;
    }

    public function setValorEntradas(string $valorEntradas): self
    {
        $this->valorEntradas = $valorEntradas;

        return $this;
    }

    public function getTotalSaidas(): ?int
    {
        return $this->totalSaidas;
    }

    public function setTotalSaidas(int $totalSaidas): self
    {
        $this->totalSaidas = $totalSaidas;

        return $this;
    }

    public function getValorSaidas(): ?string
    {
        return $this->valorSaidas;
    }

    public function setValorSaidas(string $valorSaidas): self
    {
        $this->valorSaidas = $valorSaidas;

        return $this;
    }

    public function getValorEstoqueMilhasPeriodo(): ?string
    {
        return $this->valorEstoqueMilhasPeriodo;
    }

    public function setValorEstoqueMilhasPeriodo(?string $valorEstoqueMilhasPeriodo): self
    {
        $this->valorEstoqueMilhasPeriodo = $valorEstoqueMilhasPeriodo;

        return $this;
    }

    public function getValorLucroMilhasPeriodo(): ?string
    {
        return $this->valorLucroMilhasPeriodo;
    }

    public function setValorLucroMilhasPeriodo(?string $valorLucroMilhasPeriodo): self
    {
        $this->valorLucroMilhasPeriodo = $valorLucroMilhasPeriodo;

        return $this;
    }

    public function getValorMilhaPeriodo(): ?string
    {
        return $this->valorMilhaPeriodo;
    }

    public function setValorMilhaPeriodo(?string $valorMilhaPeriodo): self
    {
        $this->valorMilhaPeriodo = $valorMilhaPeriodo;

        return $this;
    }

    public function getUsuarioFechamento(): ?Usuario
    {
        return $this->usuarioFechamento;
    }

    public function setUsuarioFechamento(?Usuario $usuarioFechamento): self
    {
        $this->usuarioFechamento = $usuarioFechamento;

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
            $movimento->setCaixa($this);
        }

        return $this;
    }

    public function removeMovimento(Movimento $movimento): self
    {
        if ($this->movimentos->removeElement($movimento)) {
            // set the owning side to null (unless already changed)
            if ($movimento->getCaixa() === $this) {
                $movimento->setCaixa(null);
            }
        }

        return $this;
    }
}
