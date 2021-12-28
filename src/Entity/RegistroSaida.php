<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RegistroSaidaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity(repositoryClass: RegistroSaidaRepository::class)]
#[ApiResource]
class RegistroSaida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'registroSaida', targetEntity: Movimento::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Movimento $movimento;

    #[ORM\ManyToOne(targetEntity: EmpresaMilha::class, inversedBy: 'registroSaidas')]
    #[ORM\JoinColumn(nullable: false)]
    private EmpresaMilha $empresaMilha;

    #[ORM\ManyToOne(targetEntity: Programa::class, inversedBy: 'registroSaidas')]
    #[ORM\JoinColumn(nullable: false)]
    private Programa $Programa;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valor;

    #[ORM\Column(type: 'integer')]
    private int $milhas;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $valorMilha;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dataSaida;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dataCompensacao;

    #[ORM\ManyToOne(targetEntity: TipoSaida::class, inversedBy: 'registroSaidas')]
    #[ORM\JoinColumn(nullable: false)]
    private TipoSaida $tipoSaida;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'registroSaidas')]
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

    public function getEmpresaMilha(): ?EmpresaMilha
    {
        return $this->empresaMilha;
    }

    public function setEmpresaMilha(?EmpresaMilha $empresaMilha): self
    {
        $this->empresaMilha = $empresaMilha;

        return $this;
    }

    public function getPrograma(): ?Programa
    {
        return $this->Programa;
    }

    public function setPrograma(?Programa $Programa): self
    {
        $this->Programa = $Programa;

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

    public function getMilhas(): ?int
    {
        return $this->milhas;
    }

    public function setMilhas(int $milhas): self
    {
        $this->milhas = $milhas;

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

    public function getDataSaida(): ?\DateTimeInterface
    {
        return $this->dataSaida;
    }

    public function setDataSaida(\DateTimeInterface $dataSaida): self
    {
        $this->dataSaida = $dataSaida;

        return $this;
    }

    public function getDataCompensacao(): ?\DateTimeInterface
    {
        return $this->dataCompensacao;
    }

    public function setDataCompensacao(\DateTimeInterface $dataCompensacao): self
    {
        $this->dataCompensacao = $dataCompensacao;

        return $this;
    }

    public function getTipoSaida(): ?TipoSaida
    {
        return $this->tipoSaida;
    }

    public function setTipoSaida(?TipoSaida $tipoSaida): self
    {
        $this->tipoSaida = $tipoSaida;

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
