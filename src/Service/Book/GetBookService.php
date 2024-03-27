<?php

namespace App\Service\Book;

use App\Entity\Book;
use App\Repository\BookRepository;

class GetBookService {
  public function __construct(
    private readonly BookRepository $bookRepository
  ) {
  }

  /**
   * @return Book[]
   */
  public function handle(): array
  {
    return $this->bookRepository->findAll();
  }
}