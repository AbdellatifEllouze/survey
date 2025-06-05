<?php

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

readonly class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(private LoggerInterface $logger) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 0],
                ['processLog', 10],
            ],
        ];
    }

    public function processException(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        $data = $this->generateContext($e);

        $result = [
            'error' => [
                'code' => $data['code'],
                'message' => $data['message'],
                'errors' => $data['errors'],
            ],
        ];

        $response = new JsonResponse($result, $data['code']);

        $event->setResponse($response);
    }

    public function processLog(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        $data = $this->generateContext($e);

        $context = [
            'code' => $data['code'],
            'message' => $e->getMessage(),
            'errors' => $data['errors'],
            'trace' => $e->getTraceAsString(),
        ];

        if (500 <= $data['code']) {
            $this->logger->critical($data['message'], $context);
        } elseif (400 <= $data['code']) {
            $this->logger->warning($data['message'], $context);
        }
    }

    private function generateContext(\Throwable $e): array
    {
        $errors = [];

        if ($e instanceof HttpExceptionInterface) {
            $previous = $e->getPrevious();

            if ($previous instanceof ValidationFailedException) {
                foreach ($previous->getViolations() as $error) {
                    $errors[$this->camelToSnakeCase($error->getPropertyPath())] = $error->getParameters()['hint'] ?? $error->getMessage();
                }
            }

            $code = $e->getStatusCode();
            $message = $e->getMessage();
        } else {
            $code = $e->getCode();
            $message = $e->getMessage();
        }

        if (Response::HTTP_INTERNAL_SERVER_ERROR < $code || Response::HTTP_MULTIPLE_CHOICES > $code) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Application error';
        }

        return [
            'code' => $code,
            'message' => $e->getMessage(),
            'errors' => $errors,
        ];
    }

    private function camelToSnakeCase(string $string): string
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $string));
    }
}
