<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class FeedbackInput
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 100)]
        public string $firstName,

        #[Assert\NotBlank]
        #[Assert\Length(max: 100)]
        public string $lastName,

        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 1000)]
        public string $comment,
    ) {
    }
}
