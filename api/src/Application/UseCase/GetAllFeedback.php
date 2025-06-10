<?php

namespace App\Application\UseCase;

use App\Domain\Port\FeedbackRepositoryInterface;

final readonly class GetAllFeedback
{
    public function __construct(
        private FeedbackRepositoryInterface $feedbackRepository,
    ) {}

    public function execute(): array
    {
        return $this->feedbackRepository->getAll();
    }
}
