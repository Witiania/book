<?php

namespace App\Controller\Api;

use App\Exception\NotFoundException;
use App\Request\Publisher\CreateOrUpdatePublisherDto;
use App\Response\Publisher\GetPublisherResponse;
use App\Service\Publisher\CreatePublisherService;
use App\Service\Publisher\DeletePublisherService;
use App\Service\Publisher\UpdatePublisherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PublisherController extends AbstractController {
    #[Route('/api/publisher', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateOrUpdatePublisherDto $createPublisherDto,
        CreatePublisherService $service,
    ): JsonResponse {
        $publisher = $service->handle($createPublisherDto);

        return new GetPublisherResponse($publisher);
    }

    #[Route('/api/publisher/{id}', methods: ['POST'])]
    public function update(
        int $id,
        #[MapRequestPayload] CreateOrUpdatePublisherDto $createPublisherDto,
        UpdatePublisherService $service,
    ): JsonResponse {
        $publisher = $service->handle($id, $createPublisherDto);

        return new GetPublisherResponse($publisher);
    }

    /**
     * @throws NotFoundException
     */
    #[Route('/api/publisher/{id}', methods: ['DELETE'])]
    public function delete(int $id, DeletePublisherService $service): JsonResponse {
        $service->handle($id);

        return $this->json(null);
    }
}