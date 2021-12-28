<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MovimentoRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity(repositoryClass: MovimentoRepository::class)]
#[ApiResource]
class Movimento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 1)]
    private string $tipoOperacao;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $data;

    #[ORM\ManyToOne(targetEntity: Caixa::class, inversedBy: 'movimentos')]
    #[ORM\JoinColumn(nullable: false)]
    private Caixa $caixa;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valor;

    #[ORM\Column(type: 'integer')]
    private int $quantidade;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'movimentos')]
    #[ORM\JoinColumn(nullable: false)]
    private Usuario $usuario;

    #[ORM\OneToOne(mappedBy: 'movimento', targetEntity: RegistroEntrada::class, cascade: ['persist', 'remove'])]
    private RegistroEntrada $registroEntrada;

    #[ORM\Column(type: 'guid')]
    private string $codigo;

    #[ORM\OneToOne(mappedBy: 'movimento', targetEntity: RegistroSaida::class, cascade: ['persist', 'remove'])]
    private RegistroSaida $registroSaida;

    public function __construct()
    {
        $this->setCodigo(UuidV6::generate())
            ->setData(new \DateTime())
        ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoOperacao(): ?string
    {
        return $this->tipoOperacao;
    }

    public function setTipoOperacao(string $tipoOperacao): self
    {
        $this->tipoOperacao = $tipoOperacao;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getCaixa(): ?Caixa
    {
        return $this->caixa;
    }

    public function setCaixa(?Caixa $caixa): self
    {
        $this->caixa = $caixa;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): self
    {
        $this->quantidade = $quantidade;

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

    public function getRegistroEntrada(): ?RegistroEntrada
    {
        return $this->registroEntrada;
    }

    public function setRegistroEntrada(RegistroEntrada $registroEntrada): self
    {
        // set the owning side of the relation if necessary
        if ($registroEntrada->getMovimento() !== $this) {
            $registroEntrada->setMovimento($this);
        }

        $this->registroEntrada = $registroEntrada;

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

    public function getRegistroSaida(): ?RegistroSaida
    {
        return $this->registroSaida;
    }

    public function setRegistroSaida(RegistroSaida $registroSaida): self
    {
        // set the owning side of the relation if necessary
        if ($registroSaida->getMovimento() !== $this) {
            $registroSaida->setMovimento($this);
        }

        $this->registroSaida = $registroSaida;

        return $this;
    }
}
