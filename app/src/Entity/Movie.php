<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Movie
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups":{"movie.read", "movie.write"}, "enable_max_depth"=true},
 *     attributes={"pagination_items_per_page": 5}
 * )
 */
class Movie
{
    /**
     * The id of the product.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * The name of the movie.
     *
     * @ORM\Column
     * @Groups({"movie.read", "movie.write"})
     * @Assert\NotBlank
     */
    private string $name;

    /**
     * The name of the director.
     *
     * @ORM\Column
     * @Groups({"movie.read", "movie.write"})
     * @Assert\NotBlank
     */
    private string $director;

    /**
     * The date of release of the movie.
     *
     * @ORM\Column(type="datetime", name="release_date")
     * @Groups({"movie.read", "movie.write"})
     * @Assert\NotBlank
     */
    private ?\DateTimeInterface $releaseDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @Groups({"movie.read", "movie.write"})
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=Cast::class, inversedBy="movies")
     * @Groups({"movie.read"})
     * @Assert\NotBlank
     */
    private $casts;

    /**
     * @var Ratings[] Available rates from this movie
     *
     * @ORM\OneToMany(
     *     targetEntity="Ratings",
     *     mappedBy="movie",
     *     cascade={"persist", "remove"})
     * @Groups({"movie.read", "movie.write"})
     * @MaxDepth(1)
     */
    private $ratings;

    public function __construct()
    {
        $this->casts = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTimeInterface $issueDate
     */
    public function setRealeaseDate(?\DateTimeInterface $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Cast>
     */
    public function getCasts(): Collection
    {
        return $this->casts;
    }

    public function addCast(Cast $cast): self
    {
        if (!$this->casts->contains($cast)) {
            $this->casts[] = $cast;
        }

        return $this;
    }

    public function removeCast(Cast $cast): self
    {
        $this->casts->removeElement($cast);

        return $this;
    }


    /**
     * @return Ratings[]
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param Ratings[] $ratings
     */
    public function setRatings($ratings)
    {
        $this->ratings = $ratings;
    }
}