<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CelebrityRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Annotation\Context;

/**
 * @ApiResource(
 *     normalizationContext={
 *          "groups": {"celebrity:read"}
 *     },
 *     denormalizationContext={
 *          "groups": {"celebrity:write"}
 *     }
 * )
 * @Gedmo\Loggable
 * @ORM\Entity(repositoryClass=CelebrityRepository::class)
 */
class Celebrity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"celebrity:read"})
     */
    private ?int $id = null;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\LessThanOrEqual(255)
     * @Groups({"celebrity:read", "celebrity:write"})
     */
    private ?string $name;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Groups({"celebrity:read", "celebrity:write"})
     * @Context({DateTimeNormalizer::FORMAT_KEY: "Y-m-d"})
     */
    private ?DateTimeInterface $birthday;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string", length=1024)
     * @Assert\NotBlank
     * @Assert\LessThanOrEqual(1024)
     * @Groups({"celebrity:read", "celebrity:write"})
     */
    private ?string $bio;

    /**
     * @ORM\OneToMany(targetEntity=Agent::class, mappedBy="celebrity", orphanRemoval=true)
     * @Groups({"celebrity:read", "celebrity:write"})
     */
    private Collection $agents;

    /**
     * @ORM\OneToMany(targetEntity=Publicist::class, mappedBy="celebrity", orphanRemoval=true)
     * @Groups({"celebrity:read", "celebrity:write"})
     */
    private Collection $publicists;

    /**
     * @ORM\OneToMany(targetEntity=Manager::class, mappedBy="celebrity", orphanRemoval=true)
     * @Groups({"celebrity:read", "celebrity:write"})
     */
    private Collection $managers;

    public function __construct()
    {
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

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

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
            $agent->setCelebrity($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agents->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getCelebrity() === $this) {
                $agent->setCelebrity(null);
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
            $publicist->setCelebrity($this);
        }

        return $this;
    }

    public function removePublicist(Publicist $publicist): self
    {
        if ($this->publicists->removeElement($publicist)) {
            // set the owning side to null (unless already changed)
            if ($publicist->getCelebrity() === $this) {
                $publicist->setCelebrity(null);
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
            $manager->setCelebrity($this);
        }

        return $this;
    }

    public function removeManager(Manager $manager): self
    {
        if ($this->managers->removeElement($manager)) {
            // set the owning side to null (unless already changed)
            if ($manager->getCelebrity() === $this) {
                $manager->setCelebrity(null);
            }
        }

        return $this;
    }
}
