<?php

namespace App\Service\Book;

use App\Entity\Book;
use App\Exception\NotFoundException;
use App\Repository\BookRepository;

class DeleteBookService {
  public function __construct(
    private readonly BookRepository $bookRepository
  ) {
  }

  public function handle(int $id): void {
    /** @var ?Book $book */
    $book = $this->bookRepository->find($id);
    if (null === $book) {
      throw new NotFoundException('Book', $id);
    }

    $this->bookRepository->delete($book);
  }
}