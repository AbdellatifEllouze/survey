<?php

namespace App\UseCase\Trait;

use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Contracts\Service\Attribute\Required;

trait DtoMapperTrait
{
    #[Required]
    private ObjectMapperInterface $objectMapper;
}
