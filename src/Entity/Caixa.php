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
    private \DateTimeInterface $dataAbertura;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTimeInterface $dataFechamento;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool $ativo;

    #[ORM\Column(type: 'integer')]
    private int $saldoMilhas;

    #[ORM\Column(type: 'integer')]
    private int $totalEntradas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valorEntradas;

    #[ORM\Column(type: 'integer')]
    private int $totalSaidas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valorSaidas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private float $valorEstoqueMilhasPeriodo;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private float $valorLucroMilhasPeriodo;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private float $valorMilhaPeriodo;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'caixas')]
    private Usuario $usuarioFechamento;

    #[ORM\OneToMany(mappedBy: 'caixa', targetEntity: Movimento::class)]
    private Collection $movimentos;

    #[ORM\Column(type: 'guid')]
    private string $codigo;

    public function __construct()
    {
        $this->movimentos = new ArrayCollection();
        $this->setAtivo(true)
            ->setDataAbertura(new \DateTime('now'))
            ->setSaldoMilhas(0)
            ->setTotalEntradas(0)
            ->setTotalSaidas(0)
            ->setValorEntradas(0)
            ->setValorEstoqueMilhasPeriodo(0)
            ->setValorLucroMilhasPeriodo(0)
            ->setValorMilhaPeriodo(0)
            ->setValorSaidas(0)
            ;
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

    public function getValorEntradas(): ?float
    {
        return $this->valorEntradas;
    }

    public function setValorEntradas(float $valorEntradas): self
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

    public function getValorSaidas(): ?float
    {
        return $this->valorSaidas;
    }

    public function setValorSaidas(float $valorSaidas): self
    {
        $this->valorSaidas = $valorSaidas;

        return $this;
    }

    public function getValorEstoqueMilhasPeriodo(): ?float
    {
        return $this->valorEstoqueMilhasPeriodo;
    }

    public function setValorEstoqueMilhasPeriodo(?float $valorEstoqueMilhasPeriodo): self
    {
        $this->valorEstoqueMilhasPeriodo = $valorEstoqueMilhasPeriodo;

        return $this;
    }

    public function getValorLucroMilhasPeriodo(): ?float
    {
        return $this->valorLucroMilhasPeriodo;
    }

    public function setValorLucroMilhasPeriodo(?float $valorLucroMilhasPeriodo): self
    {
        $this->valorLucroMilhasPeriodo = $valorLucroMilhasPeriodo;

        return $this;
    }

    public function getValorMilhaPeriodo(): ?float
    {
        return $this->valorMilhaPeriodo;
    }

    public function setValorMilhaPeriodo(?float $valorMilhaPeriodo): self
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

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }
}
