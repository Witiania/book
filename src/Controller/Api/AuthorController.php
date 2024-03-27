<?php

namespace App\Controller\Api;

use App\Exception\NotFoundException;
use App\Request\Author\CreateAuthorDto;
use App\Response\Author\GetAuthorResponse;
use App\Service\Author\CreateAuthorService;
use App\Service\Author\DeleteAuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController {
    #[Route('/api/author', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateAuthorDto $createAuthorDto,
        CreateAuthorService $service,
    ): JsonResponse {
        $author = $service->handle($createAuthorDto);
        return new GetAuthorResponse($author);
    }

    /**
     * @throws NotFoundException
     */
    #[Route('/api/author/{id}', methods: ['DELETE'])]
    public function delete(int $id, DeleteAuthorService $service): JsonResponse {
        $service->handle($id);

        return $this->json(null);
    }
}