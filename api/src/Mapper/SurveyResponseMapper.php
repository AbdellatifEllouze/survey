<?php

namespace App\Mapper;

use App\Dto\SurveyResponseInput;
use App\Entity\SurveyResponse;

class SurveyResponseMapper
{

    public function map(SurveyResponseInput $surveyResponseInput): SurveyResponse
    {
        return (new SurveyResponse())
            ->setScore($surveyResponseInput->score)
        ;
    }
}
