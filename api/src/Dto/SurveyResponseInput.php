<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class SurveyResponseInput
{
    public function __construct(
        #[Assert\NotNull]
        #[Assert\Range(min: 0, max: 10)]
        public int $score,
    ) {
    }
}
