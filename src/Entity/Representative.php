<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RepresentativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     denormalizationContext={
 *          "groups": {"representative:write"}
 *     },
 *     normalizationContext={
 *          "groups": {"representative:read"}
 *     }
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass=RepresentativeRepository::class)
 */
class Representative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"celebrity:read", "representative:read"})
     */
    private ?int $id;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\LessThanOrEqual(255)
     * @Groups({"celebrity:read", "representative:write", "representative:read"})
     */
    private ?string $name;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\LessThanOrEqual(255)
     * @Groups({"celebrity:read", "representative:write", "representative:read"})
     */
    private ?string $company;

    /**
     * @ORM\OneToMany(targetEntity=Email::class, mappedBy="representative", orphanRemoval=true, cascade={"persist"})
     * @Groups({"celebrity:read", "representative:write", "representative:read"})
     */
    private Collection $emails;

    /**
     * @ORM\OneToMany(targetEntity=Agent::class, mappedBy="representative", orphanRemoval=true)
     */
    private Collection $agents;

    /**
     * @ORM\OneToMany(targetEntity=Publicist::class, mappedBy="representative", orphanRemoval=true)
     */
    private Collection $publicists;

    /**
     * @ORM\OneToMany(targetEntity=Manager::class, mappedBy="representative", orphanRemoval=true)
     */
    private Collection $managers;

    public function __construct()
    {
        $this->emails = new ArrayCollection();
        $this->agents = new ArrayCollection();
        $this->publicists = new ArrayCollection();
        $this->managers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Email[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Email $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setRepresentative($this);
        }

        return $this;
    }

    public function removeEmail(Email $email): self
    {
        if ($this->emails->removeElement($email)) {
            // set the owning side to null (unless already changed)
            if ($email->getRepresentative() === $this) {
                $email->setRepresentative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
            $agent->setRepresentative($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getRepresentative() === $this) {
                $agent->setRepresentative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publicist[]
     */
    public function getPublicists(): Collection
    {
        return $this->publicists;
    }

    public function addPublicist(Publicist $publicist): self
    {
        if (!$this->publicists->contains($publicist)) {
            $this->publicists[] = $publicist;
            $publicist->setRepresentative($this);
        }

        return $this;
    }

    public function removePublicist(Publicist $publicist): self
    {
        if ($this->publicists->removeElement($publicist)) {
            // set the owning side to null (unless already changed)
            if ($publicist->getRepresentative() === $this) {
                $publicist->setRepresentative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Manager[]
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(Manager $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers[] = $manager;
            $manager->setRepresentative($this);
        }

        return $this;
    }

    public function removeManager(Manager $manager): self
    {
        if ($this->managers->removeElement($manager)) {
            // set the owning side to null (unless already changed)
            if ($manager->getRepresentative() === $this) {
                $manager->setRepresentative(null);
            }
        }

        return $this;
    }
}
