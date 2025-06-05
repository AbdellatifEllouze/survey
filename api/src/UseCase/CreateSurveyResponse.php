<?php

namespace App\UseCase;

use App\Dto\SurveyResponseInput;
use App\Entity\SurveyResponse;
use App\Mapper\SurveyResponseMapper;
use App\Repository\SurveyResponseRepository;

final readonly class CreateSurveyResponse
{
    public function __construct(
        private SurveyResponseMapper $surveyResponseMapper,
        private SurveyResponseRepository $surveyResponseRepository,
    ) {}

    public function execute(SurveyResponseInput $surveyResponseInput): SurveyResponse
    {
        $surveyResponse = $this->surveyResponseMapper->map($surveyResponseInput);

        $this->surveyResponseRepository->save($surveyResponse);

        return $surveyResponse;
    }
}
