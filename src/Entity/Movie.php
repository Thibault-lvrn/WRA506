<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['movie:read', 'actor:read'],'enable_max_depth'=>"true"]
)]
#[ApiFilter(OrderFilter::class, properties: ['releaseDate'])]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'name' => 'partial'])]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['movie:read', 'category:read', 'actor:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[Groups(['movie:read'])]
    private ?Category $category = null;

    #[Groups(['movie:read']), MaxDepth(1)]
    #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'movies' )]
    private Collection $actor;

    #[ORM\Column(length: 70)]
    #[Groups(['movie:read', 'actor:read', 'category:read'])]
    #[Assert\NotBlank(message: 'Le titre est obligatoire')]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['movie:read', 'category:read'])]
    #[Assert\NotBlank(message: 'La description est obligatoire')]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['movie:read'])]
    #[Assert\NotBlank(message: 'La date de sortie est obligatoire')]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column]
    #[Groups(['movie:read'])]
    #[Assert\NotBlank(message: 'La durée est obligatoire')]
    #[ApiFilter(SearchFilter::class, strategy: 'exact')]
    private ?int $duration = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'category:read'])]
    #[Assert\NotBlank(message: 'La note est obligatoire')]
    #[Assert\Range(
        min: 0,
        max: 10,
        notInRangeMessage: 'La note doit être un nombre flottant entre {{ min }} et {{ max }}.'
    )]
    private ?float $note = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Type(type: 'integer', message: 'Les entrées doivent être un nombre entier.')]
    private ?int $entries = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Type(type: 'integer', message: 'Le budget doit être un nombre entier.')]
    private ?int $budget = null;

    #[ORM\Column(nullable: false)]
    #[Assert\NotBlank(message: 'Le réalisateur est obligatoire')]
    #[Assert\Type(type: 'string', message: 'Le réalisateur doit être une chaîne de caractères.')]
    private string $director;

    #[ORM\Column(nullable: true)]
    #[Assert\Type(type: 'string', message: 'Le site web doit être une chaîne de caractères.')]
    private ?string $website = null;

    #[ORM\ManyToMany(targetEntity: MediaObject::class, inversedBy: 'movies')]
    #[Groups(['movie:read', 'movie:write', 'actor:read', 'category:read'])]
    private Collection $file;

    public function __construct()
    {
        $this->actor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actor->contains($actor)) {
            $this->actor->add($actor);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        $this->actor->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getFile(): Collection
    {
        return $this->file;
    }

    // Correction dans les méthodes addFile et removeFile
    public function addFile(MediaObject $file): static
    {
        if (!$this->file->contains($file)) {
            $this->file->add($file);
        }

        return $this;
    }

    public function removeFile(MediaObject $file): static
    {
        $this->file->removeElement($file);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @Route("/my/route")
     * @Roles({"ROLE_ADMIN", "ROLE_EDITOR"})
     */
    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getEntries(): ?int
    {
        return $this->entries;
    }

    public function setEntries(?int $entries): static
    {
        $this->entries = $entries;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function setDirector(string $director): static
    {
        $this->director = $director;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }
}
