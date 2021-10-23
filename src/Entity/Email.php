<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EmailRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Gedmo\Loggable
 * @ApiResource
 * @ORM\Entity(repositoryClass=EmailRepository::class)
 * @UniqueEntity("email")
 */
class Email
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"celebrity:read"})
     */
    private ?int $id;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email
     * @Groups({"celebrity:read", "representative:write", "representative:read"})
     */
    private ?string $email;

    /**
     * @ORM\ManyToOne(targetEntity=Representative::class, inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private ?Representative $representative;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
}
