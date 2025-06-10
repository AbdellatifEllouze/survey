<?php

namespace App\Application\Mapper;

use App\Application\Dto\FeedbackInput;
use App\Domain\Entity\Feedback;

class FeedbackMapper
{
    public function map(FeedbackInput $feedbackInput): Feedback
    {
        return (new Feedback())
            ->setFirstName($feedbackInput->firstName)
            ->setLastName($feedbackInput->lastName)
            ->setEmail($feedbackInput->email)
            ->setComment($feedbackInput->comment)
        ;
    }
}
