<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * A Cast
 * @ORM\Entity
 * @ApiResource()
 */
class Cast
{
    /**
     * The id of the cast.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * The name of the product.
     *
     * @ORM\Column
     */
    private string $name = '';

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, mappedBy="casts")
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
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
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->addCast($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeCast($this);
        }

        return $this;
    }
}