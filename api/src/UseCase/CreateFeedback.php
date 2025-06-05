<?php

namespace App\UseCase;

use App\Dto\FeedbackInput;
use App\Entity\Feedback;
use App\Mapper\FeedbackMapper;
use App\Repository\FeedbackRepository;

final readonly class CreateFeedback
{
    public function __construct(
        private FeedbackMapper $feedbackMapper,
        private FeedbackRepository $feedbackRepository,
    ) {}

    public function execute(FeedbackInput $feedbackInput): Feedback
    {
        $feedback = $this->feedbackMapper->map($feedbackInput);

        $this->feedbackRepository->save($feedback);

        return $feedback;
    }
}
