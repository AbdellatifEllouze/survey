<?php

namespace App\Mapper;

use App\Dto\FeedbackInput;
use App\Entity\Feedback;

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
