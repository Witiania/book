<?php

namespace App\Service\Author;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Request\Author\CreateAuthorDto;

class CreateAuthorService {

  public function __construct(
    private readonly AuthorRepository $authorRepository
  ) {
  }

  public function handle(CreateAuthorDto $createAuthorDto): Author {
    $author = new Author();
    $author->setFirstName($createAuthorDto->firstName);
    $author->setLastName($createAuthorDto->lastName);

    $this->authorRepository->save($author);

    return $author;
  }
}