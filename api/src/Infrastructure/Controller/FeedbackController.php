<?php

namespace App\Infrastructure\Controller;

use App\Application\Dto\FeedbackInput;
use App\Application\UseCase\GetAllFeedback;
use App\Domain\Entity\Feedback;
use App\Application\UseCase\CreateFeedback;
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

    #[OA\Get(
        description: 'Get all Feedbacks',
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'List of Feedback',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: new Model(type: Feedback::class)),
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
    #[Route('/', name: 'feedbacks_get_all', methods: ['GET'])]
    public function get(
        GetAllFeedback $getAllFeedback,
        SerializerInterface $serializer,
    ): JsonResponse {
        $feedbacks = $getAllFeedback->execute();

        return new JsonResponse(
            $serializer->normalize($feedbacks),
            Response::HTTP_OK,
        );
    }
}
