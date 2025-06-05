<?php

namespace App\Controller;

use App\Dto\FeedbackInput;
use App\Entity\Feedback;
use App\UseCase\CreateFeedback;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[OA\Tag(name: 'Feedback')]
#[Route('/api/feedbacks')]
class FeedbackController extends AbstractController
{
    #[OA\Post(
        description: 'Create Feedback',
        requestBody: new OA\RequestBody(attachables: [new Model(type: FeedbackInput::class)]),
        responses: [
            new OA\Response(
                response: Response::HTTP_CREATED,
                description: 'Feedback created',
                content: new Model(type: Feedback::class)
            ),
            new OA\Response(
                response: Response::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [new OA\Property(property: 'error', properties: [new OA\Property(property: 'code', type: 'int'), new OA\Property(property: 'message', type: 'string')], type: 'object')],
                    type: 'object',
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Application error',
                content: new OA\JsonContent(
                    properties: [new OA\Property(property: 'error', properties: [new OA\Property(property: 'code', type: 'int'), new OA\Property(property: 'message', type: 'string')], type: 'object')],
                    type: 'object',
                )
            ),
        ]
    )]
    #[Route('/', name: 'feedbacks_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] FeedbackInput $feedbackInput,
        CreateFeedback $createFeedback,
        SerializerInterface $serializer,
    ): JsonResponse {
        $feedback = $createFeedback->execute($feedbackInput);

        return new JsonResponse(
            $serializer->normalize($feedback),
            Response::HTTP_CREATED,
        );
    }
}
