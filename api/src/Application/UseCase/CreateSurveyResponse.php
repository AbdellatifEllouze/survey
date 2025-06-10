<?php

namespace App\Application\UseCase;

use App\Application\Dto\SurveyResponseInput;
use App\Domain\Entity\SurveyResponse;
use App\Application\Mapper\SurveyResponseMapper;
use App\Domain\Port\SurveyResponseRepositoryInterface;

final readonly class CreateSurveyResponse
{
    public function __construct(
        private SurveyResponseMapper $surveyResponseMapper,
        private SurveyResponseRepositoryInterface $surveyResponseRepository,
    ) {}

    public function execute(SurveyResponseInput $surveyResponseInput): SurveyResponse
    {
        $surveyResponse = $this->surveyResponseMapper->map($surveyResponseInput);

        $this->surveyResponseRepository->save($surveyResponse);

        return $surveyResponse;
    }
}
