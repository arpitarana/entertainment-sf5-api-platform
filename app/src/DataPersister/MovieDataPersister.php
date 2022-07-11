<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Movie;
use App\Entity\Ratings;
use App\Manager\MailManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class MovieDataPersister
 */
class MovieDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;

    private $security;

    private $mailManager;

    public function __construct(EntityManagerInterface $entityManager, Security $security, MailManager $mailManager)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->mailManager = $mailManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Movie;
    }

    /**
     * @param Movie $data
     */
    public function persist($data, array $context = [])
    {
        $user = $this->security->getUser();
        $data->setOwner($user);
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        if ($data->getRatings()) {
            foreach ($data->getRatings() as $ratingDetail) {
                $rating = new Ratings();
                $rating->setName($ratingDetail->getName());
                $rating->setMovie($data);
                $rating->setRate($ratingDetail->getRate());
                $this->entityManager->persist($rating);
            }
            $this->entityManager->flush();
        }

        $this->mailManager->sendEmail($user, $data);
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}
