<?php

namespace App\Service\Author;

use App\Entity\Author;
use App\Exception\NotFoundException;
use App\Repository\AuthorRepository;

class DeleteAuthorService {
  public function __construct(
    private readonly AuthorRepository $authorRepository
  ) {
  }

  public function handle(int $id): void {
    /** @var ?Author $author */
    $author = $this->authorRepository->find($id);
    if (null === $author) {
      throw new NotFoundException('Author', $id);
    }

    $this->authorRepository->delete($author);
  }
}