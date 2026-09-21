<?php

declare(strict_types=1);

namespace App\Relating\EventSubscriber;

use App\Relating\Exception\RelationRelatingApplicationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final readonly class RelationBusinessHttpExceptionSubscriber implements EventSubscriberInterface
{
    /** @return array<string, array{0: string, 1?: int}> */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 64],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();

        if (!str_starts_with($request->getPathInfo(), '/relating/')) {
            return;
        }

        $exception = $event->getThrowable();

        if ($exception instanceof RelationRelatingApplicationException) {
            $event->setResponse(new JsonResponse([
                'component' => 'Relating',
                'error' => [
                    'code' => 'business_reference_not_found',
                    'message' => $this->messageFor($exception),
                ],
            ], Response::HTTP_NOT_FOUND, [
                'X-Relating-Error' => 'business_reference_not_found',
            ]));

            return;
        }

        if (!$exception instanceof \InvalidArgumentException && !$exception instanceof \JsonException) {
            return;
        }

        $event->setResponse(new JsonResponse([
            'component' => 'Relating',
            'error' => [
                'code' => 'business_payload_invalid',
                'message' => $this->messageFor($exception),
            ],
        ], Response::HTTP_BAD_REQUEST, [
            'X-Relating-Error' => 'business_payload_invalid',
        ]));
    }

    private function messageFor(\Throwable $exception): string
    {
        if ($exception instanceof \JsonException) {
            return 'Business request payload must be valid JSON.';
        }

        $message = trim($exception->getMessage());

        return '' === $message ? 'Business request payload is invalid.' : $message;
    }
}
