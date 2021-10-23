<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Gedmo\Loggable
 * @ApiResource
 * @ORM\Entity(repositoryClass=ManagerRepository::class)
 */
class Manager implements CelebrityRepresentative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"celebrity:read"})
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Celebrity::class, inversedBy="managers")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private ?Celebrity $celebrity;

    /**
     * @ORM\ManyToOne(targetEntity=Representative::class, inversedBy="managers")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     * @Groups({"celebrity:read"})
     */
    private ?Representative $representative;

    /**
     * @ORM\ManyToOne(targetEntity=Territory::class)
     * @Groups({"celebrity:read"})
     */
    private ?Territory $territory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCelebrity(): ?Celebrity
    {
        return $this->celebrity;
    }

    public function setCelebrity(?Celebrity $celebrity): self
    {
        $this->celebrity = $celebrity;

        return $this;
    }

    public function getRepresentative(): ?Representative
    {
        return $this->representative;
    }

    public function setRepresentative(?Representative $representative): self
    {
        $this->representative = $representative;

        return $this;
    }

    public function getTerritory(): ?Territory
    {
        return $this->territory;
    }

    public function setTerritory(?Territory $territory): self
    {
        $this->territory = $territory;

        return $this;
    }

    public function getType(): string
    {
        return 'manager';
    }
}
