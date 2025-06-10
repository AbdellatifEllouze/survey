<?php

namespace App\Domain\Entity;

use App\Infrastructure\Repository\SurveyResponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: SurveyResponseRepository::class)]
#[ORM\Table(name: 'survey_responses')]
class SurveyResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private int $score;

    #[ORM\Column(name: 'submitted_at', type: 'datetime_immutable')]
    private \DateTimeImmutable $submittedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getSubmittedAt(): \DateTimeImmutable
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(\DateTimeImmutable $submittedAt): self
    {
        $this->submittedAt = $submittedAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function onPrePersistSetSubmittedAt(LifecycleEventArgs $args): void
    {
        $this->submittedAt = new \DateTimeImmutable();
    }
}
