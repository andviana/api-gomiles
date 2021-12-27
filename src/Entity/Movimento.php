<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MovimentoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovimentoRepository::class)]
#[ApiResource]
class Movimento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 1)]
    private $tipoOperacao;

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\ManyToOne(targetEntity: Caixa::class, inversedBy: 'movimentos')]
    #[ORM\JoinColumn(nullable: false)]
    private $caixa;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $valor;

    #[ORM\Column(type: 'integer')]
    private $quantidade;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'movimentos')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    #[ORM\OneToOne(mappedBy: 'movimento', targetEntity: RegistroEntrada::class, cascade: ['persist', 'remove'])]
    private $registroEntrada;

    #[ORM\Column(type: 'guid')]
    private $codigo;

    #[ORM\OneToOne(mappedBy: 'movimento', targetEntity: RegistroSaida::class, cascade: ['persist', 'remove'])]
    private $registroSaida;

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

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
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
