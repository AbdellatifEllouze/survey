<?php

namespace App\Domain\Port;

use App\Domain\Entity\SurveyResponse;

interface SurveyResponseRepositoryInterface
{
    public function save(SurveyResponse $surveyResponse): SurveyResponse;
    public function getAll(): array;
}
