<?php

namespace App\Application\UseCase;

use App\Domain\Port\SurveyResponseRepositoryInterface;

final readonly class GetAllSurveyResponse
{
    public function __construct(
        private SurveyResponseRepositoryInterface $surveyResponseRepository,
    ) {}

    public function execute(): array
    {
        return $this->surveyResponseRepository->getAll();
    }
}
