<?php

namespace App\Controller\Api;

use App\Exception\NotFoundException;
use App\Request\Book\CreateBookDto;
use App\Response\Book\GetBookResponse;
use App\Response\Book\GetBooksResponse;
use App\Service\Book\CreateBookService;
use App\Service\Book\DeleteBookService;
use App\Service\Book\GetBookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController {
    #[Route('/api/book', methods: ['GET'])]
    public function index(GetBookService $service): JsonResponse {
        $books = $service->handle();

        return new GetBooksResponse($books);
    }

    #[Route('/api/book', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateBookDto $createBookDto,
        CreateBookService $service
    ): JsonResponse {
        $book = $service->handle($createBookDto);

        return new GetBookResponse($book);
    }

    /**
     * @throws NotFoundException
     */
    #[Route('/api/book/{id}', methods: ['DELETE'])]
    public function delete(int $id, DeleteBookService $service): JsonResponse {
        $service->handle($id);

        return $this->json(null);
    }
}
