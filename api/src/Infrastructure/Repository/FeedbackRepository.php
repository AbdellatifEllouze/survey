<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Feedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Domain\Port\FeedbackRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class FeedbackRepository extends ServiceEntityRepository implements FeedbackRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feedback::class);
    }

    public function save(Feedback $feedback): Feedback
    {
        $this->getEntityManager()->persist($feedback);
        $this->getEntityManager()->flush();

        return $feedback;
    }
}
