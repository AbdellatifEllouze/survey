<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\SurveyResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Domain\Port\SurveyResponseRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class SurveyResponseRepository extends ServiceEntityRepository implements SurveyResponseRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SurveyResponse::class);
    }

    public function save(SurveyResponse $surveyResponse): SurveyResponse
    {
        $this->getEntityManager()->persist($surveyResponse);
        $this->getEntityManager()->flush();

        return $surveyResponse;
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
