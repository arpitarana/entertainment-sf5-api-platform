<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * A Ratings
 * @ORM\Entity
 */
class Ratings
{
    /**
     * The id of the Rating.
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
     * @Assert\NotBlank
     * @Groups({"movie.read", "movie.write"})
     */
    private string $name;

    /**
     * The name of the movie.
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Groups({"movie.read", "movie.write"})
     */
    private float $rate;

    /**
     * The movie of the rating.
     *
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="ratings")
     * @Groups({"movie.write"})
     */
    private Movie $movie;

    /**
     * @return int
     */
    public function getId()
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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return Movie|null
     */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    /**
     * @param Movie|null $movie
     */
    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
    }
}