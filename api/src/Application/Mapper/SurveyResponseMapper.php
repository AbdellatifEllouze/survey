<?php

namespace App\Application\Mapper;

use App\Application\Dto\SurveyResponseInput;
use App\Domain\Entity\SurveyResponse;

class SurveyResponseMapper
{

    public function map(SurveyResponseInput $surveyResponseInput): SurveyResponse
    {
        return (new SurveyResponse())
            ->setScore($surveyResponseInput->score)
        ;
    }
}
