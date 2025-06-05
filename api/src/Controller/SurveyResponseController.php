<?php

namespace App\Controller;

use App\Dto\SurveyResponseInput;
use App\Entity\SurveyResponse;
use App\UseCase\CreateSurveyResponse;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[OA\Tag(name: 'Survey response')]
#[Route('/api/survey-responses')]
class SurveyResponseController extends AbstractController
{
    #[OA\Post(
        description: 'Create Survey response',
        requestBody: new OA\RequestBody(attachables: [new Model(type: SurveyResponseInput::class)]),
        responses: [
            new OA\Response(
                response: Response::HTTP_CREATED,
                description: 'Survey response created',
                content: new Model(type: SurveyResponse::class)
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
    #[Route('/', name: 'survey_response_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] SurveyResponseInput $surveyResponseInput,
        CreateSurveyResponse $createSurveyResponse,
        SerializerInterface $serializer,
    ): JsonResponse {
        $surveyResponse = $createSurveyResponse->execute($surveyResponseInput);

        return new JsonResponse(
            $serializer->normalize($surveyResponse),
            Response::HTTP_CREATED,
        );
    }
}
