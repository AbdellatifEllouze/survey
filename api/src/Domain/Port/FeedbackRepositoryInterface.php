<?php

namespace App\Domain\Port;

use App\Domain\Entity\Feedback;

interface FeedbackRepositoryInterface
{
    public function save(Feedback $feedback): Feedback;
}
