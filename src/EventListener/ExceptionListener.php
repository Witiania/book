<?php

namespace App\EventListener;

use App\Exception\NotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ExceptionListener implements EventSubscriberInterface
{
  public static function getSubscribedEvents(): array
  {
    return [
      KernelEvents::EXCEPTION => 'onKernelException',
    ];
  }

  public function onKernelException(ExceptionEvent $event): void
  {
    $exception = $event->getThrowable();

    $response = new JsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

    switch (true) {
      case $exception instanceof ValidationFailedException:
        $response = $this->getValidationResponse($exception);
        break;
      case $exception instanceof NotFoundException:
        $response = new JsonResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        break;
    }

    $event->setResponse($response);
  }

  private function getValidationResponse(ValidationFailedException $exception): JsonResponse {
    $errors = [];

    foreach ($exception->getViolations() as $violation) {
      $errors[] = $violation->getMessage();
    }

    $responseData = [
      'errors' => $errors,
    ];

    return new JsonResponse($responseData, Response::HTTP_UNPROCESSABLE_ENTITY);
  }
}