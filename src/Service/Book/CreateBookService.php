<?php

namespace App\Service\Book;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\PublisherRepository;
use App\Request\Book\CreateBookDto;

class CreateBookService {

  public function __construct(
    private readonly BookRepository $bookRepository,
    private readonly PublisherRepository $publisherRepository,
    private readonly AuthorRepository $authorRepository,
  ) {
  }

  public function handle(CreateBookDto $createAuthorDto): Book {
    /** @var ?Publisher $publisher */
    $publisher = $this->publisherRepository->find($createAuthorDto->publisherId);

    /** @var Author[] $authors */
    $authors = $this->authorRepository->findBy(['id' => $createAuthorDto->authorIds]);

    $book = new Book();
    $book->setTitle($createAuthorDto->title);
    $book->setYear($createAuthorDto->year);
    $book->setPublisher($publisher);

    $this->bookRepository->save($book);

    foreach ($authors as $author) {
      $book->addAuthor($author);
    }
    $this->bookRepository->save($book);

    return $book;
  }
}