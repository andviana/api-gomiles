<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RegistroEntradaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity(repositoryClass: RegistroEntradaRepository::class)]
#[ApiResource]
class RegistroEntrada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'registroEntrada', targetEntity: Movimento::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Movimento $movimento;

    #[ORM\ManyToOne(targetEntity: Programa::class, inversedBy: 'registroEntradas')]
    #[ORM\JoinColumn(nullable: false)]
    private Programa $programa;

    #[ORM\Column(type: 'integer')]
    private int $milhas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valor;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valorMilha;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dataEntrada;

    #[ORM\ManyToOne(targetEntity: TipoEntrada::class, inversedBy: 'registroEntradas')]
    #[ORM\JoinColumn(nullable: false)]
    private TipoEntrada $tipoEntrada;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'registroEntradas')]
    #[ORM\JoinColumn(nullable: false)]
    private Usuario $usuario;

    #[ORM\Column(type: 'guid')]
    private string $codigo;

    public function __construct()
    {
        $this->setCodigo(UuidV6::generate());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovimento(): ?Movimento
    {
        return $this->movimento;
    }

    public function setMovimento(Movimento $movimento): self
    {
        $this->movimento = $movimento;

        return $this;
    }

    public function getPrograma(): ?Programa
    {
        return $this->programa;
    }

    public function setPrograma(?Programa $programa): self
    {
        $this->programa = $programa;

        return $this;
    }

    public function getMilhas(): ?int
    {
        return $this->milhas;
    }

    public function setMilhas(int $milhas): self
    {
        $this->milhas = $milhas;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getValorMilha(): ?string
    {
        return $this->valorMilha;
    }

    public function setValorMilha(string $valorMilha): self
    {
        $this->valorMilha = $valorMilha;

        return $this;
    }

    public function getDataEntrada(): ?\DateTimeInterface
    {
        return $this->dataEntrada;
    }

    public function setDataEntrada(\DateTimeInterface $dataEntrada): self
    {
        $this->dataEntrada = $dataEntrada;

        return $this;
    }

    public function getTipoEntrada(): ?TipoEntrada
    {
        return $this->tipoEntrada;
    }

    public function setTipoEntrada(?TipoEntrada $tipoEntrada): self
    {
        $this->tipoEntrada = $tipoEntrada;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

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
