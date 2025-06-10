<?php

namespace App\Application\UseCase;

use App\Application\Dto\FeedbackInput;
use App\Domain\Entity\Feedback;
use App\Application\Mapper\FeedbackMapper;
use App\Domain\Port\FeedbackRepositoryInterface;

final readonly class CreateFeedback
{
    public function __construct(
        private FeedbackMapper $feedbackMapper,
        private FeedbackRepositoryInterface $feedbackRepository,
    ) {}

    public function execute(FeedbackInput $feedbackInput): Feedback
    {
        $feedback = $this->feedbackMapper->map($feedbackInput);

        $this->feedbackRepository->save($feedback);

        return $feedback;
    }
}
